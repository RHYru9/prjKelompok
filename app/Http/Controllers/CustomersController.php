<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
    public function __construct()
    {
        // Middleware untuk membatasi akses hanya admin
        $this->middleware(function ($request, $next) {
            $user = Auth::user();

            if (!$user || $user->role !== 'admin') {
                abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
            }

            return $next($request);
        });
    }

    /**
     * Menampilkan daftar customer/driver dengan filter dan pagination.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $role = $request->input('role');
        $perPage = $request->input('per_page', 10);

        $customers = Customer::query()
            ->where('role', '!=', 'admin')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('username', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($role, function ($query) use ($role) {
                return $query->where('role', $role);
            })
            ->paginate($perPage);

        return view('Customers.index', compact('customers', 'search', 'role', 'perPage'));
    }

    /**
     * Menampilkan form tambah customer.
     */
    public function create()
    {
        return view('Customers.create');
    }

    /**
     * Menyimpan data customer baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'username'        => 'required|string|max:255|unique:users',
            'email'           => 'required|email|max:255|unique:users',
            'nomer_rekening'  => 'nullable|string|max:14',
            'nama_rekening'   => 'nullable|string|max:255',
            'dob'             => 'nullable|date',
            'role'            => 'required|in:customer,driver',  // Validasi role
            'password'        => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[!@#$%^&*(),.?":{}|<>]/',
            ],
        ]);

        $validated['password'] = Hash::make($request->password);

        Customer::create($validated);

        return redirect()->route('customer.index')->with('success', 'Berhasil Menambahkan Customer!');
    }

    /**
     * Menampilkan form edit customer.
     */
    public function edit(Customer $customer)
    {
        return view('Customers.edit', compact('customer'));
    }

    /**
     * Memperbarui data customer.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'username'        => 'required|string|max:255|unique:users,username,' . $customer->id,
            'email'           => 'required|email|max:255|unique:users,email,' . $customer->id,
            'nomer_rekening'  => 'nullable|string|max:14',
            'nama_rekening'   => 'nullable|string|max:255',
            'dob'             => 'nullable|date',
            'role'            => 'required|in:customer,driver',  // Validasi role
            'password'        => [
                'nullable',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[!@#$%^&*(),.?":{}|<>]/',
            ],
        ]);

        // Hanya update password jika diisi
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // Hapus password dari array jika kosong
        }

        $customer->update($validated);

        return redirect()->route('customer.index')->with('success', 'Berhasil Memperbarui Customer!');
    }

    /**
     * Menghapus data customer.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'Berhasil Menghapus Customer!');
    }
}
