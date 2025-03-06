<?php
require_once('model/database.php');
require_once('model/assignment_db.php');
require_once('model/course_db.php');

$assignment_id = filter_input(INPUT_POST, 'assignment_id', FILTER_VALIDATE_INT);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
$course_name = filter_input(INPUT_POST, 'course_name', FILTER_SANITIZE_SPECIAL_CHARS);

$course_id = filter_input(INPUT_POST, 'course_id', FILTER_VALIDATE_INT) ?: filter_input(INPUT_GET, 'course_id', FILTER_VALIDATE_INT);

$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW) ?: filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW) ?: 'list_assignments';

switch ($action) {
    case "list_courses":
        $courses = get_courses();
        include('view/course_list.php');
        break;
    case "add_course":
        if (!empty($course_name)) {
            add_course($course_name);
            header("Location: .?action=list_courses");
            exit();
        } else {
            $error = "Invalid course name. Please check the field and try again.";
            include("view/error.php");
            exit();
        }
        break;
    case "add_assignment":
        if ($course_id && !empty($description)) {
            add_assignment($course_id, $description);
            header("Location: .?action=list_assignments&course_id=" . $course_id);
            exit();
        } else {
            $error = "Invalid assignment data. Check all fields and try again.";
            include("view/error.php");
            exit();
        }
        break;
    case "delete_course":
        if ($course_id) {
            try {
                delete_course($course_id);
                header("Location: .?action=list_courses");
                exit();
            } catch (PDOException $e) {
                $error = "You cannot delete a course if assignments exist in the course.";
                include('view/error.php');
                exit();
            }
        }
        break;
    
    case 'show_update_course':
        $course_id = filter_input(INPUT_GET, 'course_id', FILTER_VALIDATE_INT);
        if ($course_id) {
            $course = get_course($course_id);
            include('view/update_course.php');
        } else {
            header("Location: .");
        }
        break;
        
    case 'update_course':
        $course_id = filter_input(INPUT_POST, 'course_id', FILTER_VALIDATE_INT);
        $course_name = filter_input(INPUT_POST, 'course_name', FILTER_SANITIZE_STRING);
            
        if ($course_id && $course_name) {
            update_course($course_id, $course_name);
            header("Location: .?action=list_courses");
         } else {
            $error_message = "Invalid course data. Check all fields and try again.";
            include('view/error.php');
        }
        break;
    
    case "delete_assignment":
        if ($assignment_id) {
            delete_assignment($assignment_id);
            header("Location: .?action=list_assignments&course_id=" . $course_id);
            exit();
        } else {
            $error = "Missing or incorrect assignment id.";
            include('view/error.php');
            exit();
        }
        break;

    case 'show_update_assignment':
        $assignment_id = filter_input(INPUT_GET, 'assignment_id', FILTER_VALIDATE_INT);
        if ($assignment_id) {
            $assignment = get_assignment($assignment_id);
            include('view/update_assignment.php');
        } else {
            header("Location: .");
        }
        break;

    case 'update_assignment':
        $assignment_id = filter_input(INPUT_POST, 'assignment_id', FILTER_VALIDATE_INT);
        $assignment_name = filter_input(INPUT_POST, 'assignment_name', FILTER_SANITIZE_STRING);
        
        if ($assignment_id && $assignment_name) {
            update_assignment($assignment_id, $assignment_name);
            header("Location: .?action=list_assignments&course_id=" . $course_id);
        } else {
            $error = "Invalid assignment data. Check all fields and try again.";
            include('view/error.php');
        }
        break;

    default:
        $courses = get_courses();
        $assignments = get_assignments_by_course($course_id);
        include('view/assignment_list.php');
}