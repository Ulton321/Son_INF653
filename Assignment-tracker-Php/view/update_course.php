<?php include('header.php'); ?>

<div class="container">
    <h1>Update Course</h1>
    <?php if (!empty($course)) : ?>
        <form action="." method="POST">
            <input type="hidden" name="action" value="update_course">
            <input type="hidden" name="course_id" value="<?php echo $course['course_id']; ?>">
            
            <div class="form-group">
                <label for="course_name">Course Name:</label>
                <input type="text" id="course_name" name="course_name" 
                       value="<?php echo $course['course_name']; ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Course</button>
            <a href="." class="btn btn-secondary">Cancel</a>
        </form>
    <?php endif; ?>
</div>

<?php include('footer.php'); ?>