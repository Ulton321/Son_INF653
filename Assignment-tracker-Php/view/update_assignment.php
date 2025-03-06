<?php include('header.php'); ?>

<div class="container">
    <h1>Update Assignment</h1>
    <?php if (!empty($assignment)) : ?>
        <form action="." method="POST">
            <input type="hidden" name="action" value="update_assignment">
            <input type="hidden" name="assignment_id" value="<?php echo $assignment['assignment_id']; ?>">
            
            <div class="form-group">
                <label for="assignment_name">Assignment Name:</label>
                <input type="text" id="assignment_name" name="assignment_name" 
                       value="<?php echo $assignment['assignment_name']; ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Assignment</button>
            <a href="." class="btn btn-secondary">Cancel</a>
        </form>
    <?php endif; ?>
</div>

<?php include('footer.php'); ?>