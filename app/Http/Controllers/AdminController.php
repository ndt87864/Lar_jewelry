<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\Orders;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Hiển thị danh sách danh mục
    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Hiển thị form tạo danh mục mới
    public function createCategory()
    {
        $categories = Category::all(); // Lấy tất cả danh mục
        return view('admin.categories.create', compact('categories'));
    }

    // Xử lý lưu danh mục mới
    // Xử lý lưu danh mục mới
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Thêm quy tắc cho hình ảnh
        ]);

        $data = $request->all();

        // Nếu có hình ảnh, lưu hình ảnh
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('categories', $imageName, 'public');
            $data['image'] = 'categories/' . $imageName; // Lưu đường dẫn hình ảnh
        }

        Category::create($data);
        return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được thêm thành công');
    }


    // Hiển thị form chỉnh sửa danh mục
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    // Xử lý cập nhật danh mục
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = Category::findOrFail($id);

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            $imagePath = $request->file('image')->store('categories', 'public');
            $category->image = $imagePath;

        }

        // Cập nhật tên danh mục
        $category->name = $request->name;
        $category->save();
        if ($category->save()) {
            return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được cập nhật thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật không thành công, vui lòng thử lại!');
        }

    }


    // Xử lý xóa danh mục
    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories.index');
    }

    // Hiển thị danh sách sản phẩm
    public function products()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    // Hiển thị form tạo sản phẩm mới
    public function createProduct()
    {

        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }


    public function showProduct(Product $product, $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    // Xử lý lưu sản phẩm mới
    public function storeProduct(Request $request)
    {
        // Validation dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation hình ảnh
        ]);

        // Kiểm tra xem có ảnh được tải lên không
        if ($request->hasFile('image')) {
            // Lưu ảnh mới vào thư mục 'products'
            $imagePath = $request->file('image')->store('products', 'public');
            $request->merge(['image' => $imagePath]);
        } else {
            // Nếu không có ảnh được tải lên, sử dụng ảnh mặc định
            $request->merge(['image' => 'products/no.jpg']); // Đường dẫn tới ảnh mặc định
        }

        // Tạo sản phẩm mới với dữ liệu từ request
        Product::create($request->all());

        // Chuyển hướng sau khi thêm sản phẩm thành công
        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công.');
    }

    // Xử lý cập nhật sản phẩm
    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra hình ảnh
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            // Lưu ảnh mới
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        // Cập nhật các thông tin khác
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công.');
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function editProduct($id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Xử lý xóa sản phẩm
    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index');
    }
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Hiển thị form tạo người dùng
    public function create()
    {
        return view('admin.users.create');
    }

    // Lưu người dùng mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation cho hình ảnh
        ]);

        $data = $request->all();

        // Lưu hình ảnh nếu có
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'public');
            $data['image'] = $imagePath; // Lưu đường dẫn hình ảnh
        } else {
            // Nếu không có ảnh được tải lên, sử dụng ảnh mặc định
            $request->merge(['image' => 'products/no.jpg']); // Đường dẫn tới ảnh mặc định
        }

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $request->has('is_admin') ? 'admin' : 'customer',
            'image' => $data['image'], // Lưu hình ảnh
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Thêm tài khoản thành công!');
    }


    // Hiển thị form chỉnh sửa người dùng
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed', // Password có thể bỏ trống
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra hình ảnh
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        // Cập nhật hình ảnh
        if ($request->hasFile('image')) {
            // Xóa hình cũ nếu có
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // Lưu hình ảnh mới
            $imagePath = $request->file('image')->store('users', 'public');
            $user->image = $imagePath; // Cập nhật đường dẫn hình ảnh
        }

        // Chỉ cập nhật password nếu có giá trị mới
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->role = $request->has('is_admin') ? 'admin' : 'customer';
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật tài khoản thành công!');
    }


    // Xóa người dùng 
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.users.index')->with('success', 'Xoá tài khoản thành công!');
    }

    // Hiển thị danh sách đơn hàng
    public function orders()
    {
        $orders = Orders::with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Hiển thị form tạo đơn hàng mới
    public function createOrder()
    {
        $users = User::all(); // Lấy tất cả người dùng
        return view('admin.orders.create', compact('users'));
    }

    // Xử lý lưu đơn hàng mới
    public function storeOrder(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'status' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        Orders::create($request->all());

        return redirect()->route('admin.orders.index')->with('success', 'Thêm đơn hàng thành công.');
    }

    // Hiển thị form chỉnh sửa đơn hàng
    public function editOrder($id)
    {
        $order = Orders::findOrFail($id);
        $users = User::all(); // Lấy tất cả người dùng
        return view('admin.orders.edit', compact('order', 'users'));
    }

    // Xử lý cập nhật đơn hàng
    public function updateOrder(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'status' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $order = Orders::findOrFail($id);
        $order->update($request->all());

        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật đơn hàng thành công.');
    }
    public function updateStatus(Request $request, $id)
    {
    // Cập nhật trạng thái đơn hàng
    $order = Orders::findOrFail($id);
    $order->status = $request->status; // status có thể là 'paid' hoặc 'cancelled'
    $order->save();
    return redirect()->route('admin.orders.index')->with('success', 'Cập nhật trạng thái đơn hàng thành
    công!');
    }
    // Xử lý xóa đơn hàng
    public function destroyOrder($id)
    {
        $order = Orders::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Xoá đơn hàng thành công.');
    }
    public function showOrder($id)
    {
        // Lấy thông tin chi tiết đơn hàng theo ID
        $order = Orders::with('user', 'items.product')->findOrFail($id);
    
        return view('admin.orders.show', compact('order'));
    }
    
    public function indexPayment()
    {
        // Thống kê tổng doanh thu theo từng danh mục
        $categoryRevenue = DB::table('order_items')
            ->select('products.category_id', DB::raw('SUM(order_items.price * order_items.quantity) as total_revenue'))
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.orders_id', '=', 'orders.id') // Sử dụng orders để lấy thông tin đơn hàng
            ->where('orders.status', 'paid') // Kiểm tra trạng thái đơn hàng
            ->groupBy('products.category_id')
            ->get();
        // Tổng số đơn hàng
        $totalOrders = Orders::count();
        // Tổng số khách hàng
        $totalCustomers = DB::table('users')->where('role', 'customer')->count();
        // Doanh thu theo ngày từ bảng payments
        $revenueByDate = DB::table('payments')
            ->select(DB::raw('DATE(payment_date) as date, SUM(amount) as total_revenue'))
            ->groupBy('date')
            ->get();// Doanh thu theo tháng từ bảng payments
        $revenueByMonth = DB::table('payments')
            ->select(DB::raw('MONTH(payment_date) as month, SUM(amount) as total_revenue'))
            ->groupBy('month')
            ->get();
        // Doanh thu theo năm từ bảng payments
        $revenueByYear = DB::table('payments')
            ->select(DB::raw('YEAR (payment_date) as year, SUM(amount) as total_revenue'))
            ->groupBy('year')
            ->get();
        // Doanh thu theo phương thức thanh toán
        $revenueByPaymentMethod = DB::table('payments')
            ->select('payment_method', DB::raw('SUM(amount) as total_revenue'))
            ->groupBy('payment_method')
            ->get();
        return view('admin.reports.index', compact(
            'categoryRevenue',
            'totalOrders',
            'totalCustomers',
            'revenueByDate',
            'revenueByMonth',
            'revenueByYear',
            'revenueByPaymentMethod' // Thêm vào compact
        ));
    }
}
