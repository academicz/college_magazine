<?php

namespace App\Http\Controllers;

use App\Http\Requests\addCourse;
use App\Http\Requests\AddDepartmentRequest;
use App\Http\Requests\AddFacultyRequest;
use App\Http\Requests\AddModerator;
use App\Http\Requests\addStudent;
use App\Models\Course;
use App\Models\Department;
use App\Models\FacultyDetails;
use App\Models\Login;
use App\Models\StudentDetails;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * User Type 0:admin 1:user 2:faculty 3:moderator
     *
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('isAdmin');
    }


    /**
     * display home page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHome()
    {
        $data = [
            'admin' => $this->checkAdminLogin(),
        ];
        return view('Admin.home', $data);
    }

    /**
     * display departments page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDepartments()
    {
        $data = [
            'admin' => $this->checkAdminLogin(),
        ];

        return view('Admin.departments', $data);
    }

    /**
     * add new department
     * @param AddDepartmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addDepartments(AddDepartmentRequest $request)
    {
        $department = new Department();
        $department->department_name = $request['departmentName'];
        $department->save();

        return response()->json(['status' => true, 'message' => 'Department Added Successfully']);
    }

    /**
     * get departments data
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDepartmentsDetails()
    {
        $departments = Department::paginate(5);
        return response()->json(['departments' => $departments]);
    }

    /**
     * delete department data
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteDepartment(Request $request)
    {
        $department = Department::where('id', $request['department_id'])->first();
        if (!$department->course->count()) {
            $department->delete();
            return response()->json(['status' => true, 'message' => 'Department Deleted Successfully']);
        }
        return response()->json(['status' => false, 'message' => "Can't delete department, relational data exist"]);
    }

    /**
     * display course page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCoursePage()
    {
        $data = [
            'admin' => $this->checkAdminLogin(),
        ];

        return view('Admin.courses', $data);
    }

    /**
     * add new course
     * @param addCourse $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCourse(AddCourse $request)
    {
        $course = new Course();
        $course->department_id = $request['departmentId'];
        $course->course_name = $request['courseName'];
        $course->save();

        return response()->json(['status' => true, 'message' => 'Course Added Successfully']);
    }

    /**
     * get add department details
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllDepartments()
    {
        $departments = Department::all();
        return response()->json($departments);
    }

    /**
     * get all course details
     */
    public function getCourses()
    {
        $courses = Course::with('department')->paginate(10);
        return response()->json(['courses' => $courses]);
    }

    /**
     * Delete course
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCourse(Request $request)
    {
        $course = Course::where('id', $request['course_id'])->first();
        if (!$course->users->count()) {
            $course->delete();
            return response()->json(['status' => true, 'message' => 'Course Deleted Successfully']);
        }
       return response()->json(['status' => false, 'message' => "Can't delete course, relational data exist"]);
    }

    /**
     * display student adding page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStudentsPage()
    {
        $data = [
            'admin' => $this->checkAdminLogin(),
        ];

        return view('Admin.students', $data);
    }

    /**
     * get all course details
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCourses()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    /**
     * Add new student
     * @param addStudent $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addStudent(AddStudent $request)
    {
        /*
         * User table
         */
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->user_type = 1;
        $user->status = 1;
		$user->about='';
        $user->save();

        /*
         * Student Details table
         */
        $student = new StudentDetails();
        $student->user_id = $user->id;
        $student->reg_no = $request['regNo'];
        $student->course_id = $request['courseId'];
        $student->save();

        /*
         * Login table
         */
        $login = new Login();
        $login->user_id = $user->id;
        $login->email = $request['email'];
        $login->password = bcrypt($request['phone']);
        $login->user_type_id = $user->user_type;
        $login->save();

        return response()->json(['status' => true, 'message' => 'Student Added Successfully']);
    }

    /**
     * get student details
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStudentDetails()
    {
        $students = User::where('user_type', 1)->with('student_details.course')->paginate(10);

        return response()->json(['students' => $students]);
    }

    /**
     * Delete student details
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteStudent(Request $request)
    {
        $user = User::where('id', $request['id'])->first();

        /*
         * Deleting student details
         */
        $user->student_details->delete();

        /*
         * Deleting Login Details
         */
        $user->login->delete();

        /*
         * Deleting user details
         */
        $user->delete();

        return response()->json(['status' => true, 'message' => 'Student Removed Successfully']);
    }
    public function changeStatus(Request $request)
    {
        $user = User::where('id', $request['id'])->first();
        $user->login->user_type_id=3;
        $user->login->save();
        $user->user_type=3;
        $user->save();

        return response()->json(['status' => true, 'message' => 'Student Changed to moderator']);
    }

    public function getFacultyPage()
    {
        $data = [
            'admin' => $this->checkAdminLogin(),
        ];

        return view('Admin.faculties', $data);
    }

    public function getFacultyDetails()
    {
        $faculty = User::where('user_type', 2)->with('faculty_details.department')->paginate(2);

        return response()->json(['faculties' => $faculty]);
    }

    public function addFaculty(AddFacultyRequest $request)
    {
        /*
         * User Details
         */
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->user_type = 2;
        $user->status = 1;
		$user->about='';
        $user->save();

        /*
         * Faculty details
         */
        $faculty = new FacultyDetails();
        $faculty->user_id = $user->id;
        $faculty->department_id = $request['departmentId'];
        $faculty->save();

        /*
         * Login table
         */
        $login = new Login();
        $login->user_id = $user->id;
        $login->email = $request['email'];
        $login->password = bcrypt($request['phone']);
        $login->user_type_id = $user->user_type;
        $login->save();
        return response()->json(['status' => true, 'message' => 'Faculty Added Successfully']);
    }

    /**
     * remove faculty
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFaculty(Request $request)
    {
        $user = User::where('id', $request['id'])->first();

        /*
         * Deleting Login Details
         */
        $user->login->delete();

        /*
         * Deleting user details
         */
        $user->delete();

        return response()->json(['status' => true, 'message' => 'Faculty Removed Successfully']);
    }

    public function getModeratorsPage()
    {
        $data = [
            'admin' => $this->checkAdminLogin(),
        ];
        return view('Admin.moderator', $data);
    }

    public function postModerators(AddModerator $request)
    {
        /*
        * User Details
        */
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->user_type = 3;
        $user->status = 1;
		$user->about='';
        $user->save();

        /*
         * Login table
         */
        $login = new Login();
        $login->user_id = $user->id;
        $login->email = $request['email'];
        $login->password = bcrypt($request['phone']);
        $login->user_type_id = $user->user_type;
        $login->save();
        return response()->json(['status' => true, 'message' => 'Moderator Added Successfully']);
    }

    public function getModerators()
    {
        $moderators = User::where('user_type', 3)->paginate(10);

        return response()->json(['moderators' => $moderators]);
    }
}