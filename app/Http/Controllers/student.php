<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\student as ModelsStudent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class student extends Controller
{
    public function showBlade(){
        return view("f1");
    }
     public function insertRecords(Request $r){
        $student=new ModelsStudent();
         $student->username=$r->username;
         $student->firstname=$r->firstname;
         $student->lastname=$r->lastname;
         $student->email=$r->email;
        $student->password = Hash::make($r->password);
         $student->save();
        //return response()->json([
        //'message' => 'data inserted //successfully'
    //]);
        return
    redirect()->back()->with('success', 'student inserted successfully');
    }

   /* public function store(Request $r){
        $validated = $r->validate([
           'firstname' => 'required|string|max:50',
           'lastname' => 'required|string|max:50',
            'username' => 'required|string|unique:students,username',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:8'
        ]);

        $student = new Student();
        $student->firstname = $validated['firstname'];
        $student->lastname = $validated['lastname'];
        $student->username = $validated['username'];
        $student->email = $validated['email'];
        $student->password = Hash::make($validated['password']);
        $student->save();

    }*/

    public function delete($id){
        ModelsStudent::find($id)->delete();
         return
    redirect()->back()->with('success', 'student deleted successfully');
    }

    public function edit($id){
        $student = ModelsStudent::find($id);
        $students = ModelsStudent::all();

        return view('form',compact('student', 'students'));
    }
    public function update(Request $r, $id){
        $student = ModelsStudent::find($id);

        $student->update([
            'firstname'=>$r->firstname,
            'lastname'=>$r->lastname,
            'username'=>$r->username,
            'email'=>$r->email,
            'password' => Hash::make($r->password),
        ]);
        return
    redirect('/form')->with('success', 'student updated successfully');
    }
    //   public function insertRecords(){
    //     $result = ModelsStudent::create([
    //             'username'=>'maze',
    //             'firstname'=>'maze',
    //             'lastname'=>'maze',
    //             'email'=>'mike@gmail.com'
    //     ]);
    //     return response()->json(
    //        [
    //          'message'=>'data inserted success fully',
    //         'data'=>$result
    //         ]
    //     );
    // }
   //  public function showrecords(){
     //   $result = ModelsStudent::all();
    //    return response()->json($result);
  //  }

    public function showrecords(){
    $students = ModelsStudent::all();
    return view('form', compact('students'));
}
}
