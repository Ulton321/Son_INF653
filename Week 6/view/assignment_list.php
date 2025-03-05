<?php
include('view/header.php');
?>

<!-- Section to Display Assignments -->
<section class="assignment-container">
    <h2>Assignments</h2>
    <form action="." method="get">
        <select name="course_id">
            <option value="0">View All</option>
            <?php foreach ($courses as $course) : ?>
                <option value="<?= $course['courseID'] ?>" <?= $course_id == $course['courseID'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($course['courseName']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Go</button>
    </form>

    <?php if (!empty($assignments)) : ?>
        <?php foreach ($assignments as $assignment) : ?>
            <div class="assignment-item">
                <p><strong><?= htmlspecialchars($assignment['courseName']) ?></strong></p>
                <p><?= htmlspecialchars($assignment['Description']) ?></p>
                <form action="." method="post">
                    <input type="hidden" name="action" value="delete_assignment">
                    <input type="hidden" name="assignment_id" value="<?= $assignment['ID'] ?>">
                    <button type="submit" class="remove-button" onclick="return confirm('Are you sure you want to delete this assignment?')">X</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No assignments exist<?= $course_id ? ' for this course' : '' ?> yet.</p>
    <?php endif; ?>
</section>



<section class="assignment-container">
    <h2>Add Assignment</h2>

    <form action="." method="post">
        <select name="course_id" required>
            <option value="">Please select</option>
            <?php foreach ($courses as $course) : ?>

                <option value="<?= $course['courseID'] ?>">
                    <?= htmlspecialchars($course['courseName']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="text" name="description" maxlength="120" placeholder="Description" required>
        <button type="submit" name="action" value="add_assignment">Add</button>
    </form>
</section>


<p><a href=".?action=list_courses">View/Edit Courses</a></p>

<?php
include('view/footer.php');
?>