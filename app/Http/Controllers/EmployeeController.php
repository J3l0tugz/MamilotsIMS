<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class EmployeeController extends Controller
{
    public function employeeIndex()
    {
        $employees = User::select('id', 'first_name', 'middle_name', 'last_name', 'address', 'date_of_birth', 'sex', 'phone_no', 'salary', 'employee_id', 'role')->get();

        // return view('pages.employees');

        if (Auth::user()->role === 1) {
            return view('pages.manager.employees', compact('employees'));
        } elseif (Auth::user()->role === 0) {
            return view('pages.employee.employees', compact('employees'));
        }
    }

    public function addEmployee()
    {
        return view('pages.manager.addEmployee')->with(['succes' => 'success']);
    }

    public function saveEmployee(Request $request)
    {
        $requestData = $request->all();
        // Remove the PHP sign (₱) from the salary value
        $salaryWithoutSign = str_replace('₱', '', $requestData['salary']);

        // Remove commas from the salary value
        $salaryWithoutCommas = str_replace(',', '', $salaryWithoutSign);

        // Convert the cleaned salary value to a float
        $salaryFloat = (float) $salaryWithoutCommas;

        // Merge the updated salary value back into the request
        $request->merge(['salary' => $salaryFloat]);

        $request->merge(['first_name' => ucwords($requestData['first_name'])]);
        $request->merge(['middle_name' => ucwords($requestData['middle_name'])]);
        $request->merge(['last_name' => ucwords($requestData['last_name'])]);
        $request->merge(['address' => ucwords($requestData['address'])]);

        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'address' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'sex' => 'required',
            'phone_no' => 'required|regex:/^09\d{9}$/|unique:users',
            'salary' => 'required',
            'employee_id' => 'required',
            'role' => 'required',
            'password' => 'required'
        ]);

        User::create($validated);

        return redirect()->route('employee.index')
            ->with('create success', 'Employee record was successfully created.');
    }

    public function getEmployee(int $id)
    {
        $employee = User::find($id);

        return view('pages.manager.employeeInfo', compact('employee'));
    }

    public function editEmployee(int $id)
    {
        $employee = User::find($id);
        return view('pages.manager.editEmployee', compact('employee'));
    }

    public function updateEmployee(Request $request, $id)
    {
        $requestData = $request->all();
        // Remove the PHP sign (₱) from the salary value
        $salaryWithoutSign = str_replace('₱', '', $requestData['salary']);

        // Remove commas from the salary value
        $salaryWithoutCommas = str_replace(',', '', $salaryWithoutSign);

        // Convert the cleaned salary value to a float
        $salaryFloat = (float) $salaryWithoutCommas;

        // Merge the updated salary value back into the request
        $request->merge(['salary' => $salaryFloat]);

        $capitalize = $request->all();
        $request->merge(['first_name' => ucwords($requestData['first_name'])]);
        $request->merge(['middle_name' => ucwords($requestData['middle_name'])]);
        $request->merge(['last_name' => ucwords($requestData['last_name'])]);
        $request->merge(['address' => ucwords($requestData['address'])]);

        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'address' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'sex' => 'required',
            'phone_no' => 'required|regex:/^09\d{9}$/|unique:users,phone_no,' . $id,
            'salary' => 'required',
        ]);

        $employee = User::find($id);
        $employee->update($validated);

        return redirect()->route('employee.index')
            ->with('updated', 'Employee has been updated successfully.');
    }

    public function deleteEmployee($id)
    {

        $employee = User::find($id);
        $employee->delete();
        return redirect()->route('employee.index')
            ->with('delete success', 'Employee has been deleted successfully.');
    }

    public function resetPassword(Request $request, $id){
        $validated = request()->validate([
            'password' => 'sometimes|nullable'
        ]);

        $employee = User::find($id);
        $employee->update($validated);

        return redirect()->route('employee.index')
            ->with('updated', 'Password reset was successful.');
    }

}

