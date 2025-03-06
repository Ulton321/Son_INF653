<?php include("view/header.php"); ?>

<!-- Display Courses -->
<?php if (!empty($courses)) : ?>
    <section id="list" class="course-container">
        <header>
            <h1>Course List</h1>
        </header>

        <?php foreach ($courses as $course) : ?>
            <div class="list__row">
                <div class="list__item">
                    <p class="bold"><?= htmlspecialchars($course['courseName']) ?></p>
                </div>
                <div class="list__removed">
                    <form action="." method="post" style="display: inline;">
                        <input type="hidden" name="action" value="delete_course">
                        <input type="hidden" name="course_id" value="<?= $course['courseID'] ?>">
                        <button class="remove-button" onclick="return confirm('Are you sure you want to delete this course?')">X</button>
                    </form>
                    <form action="." method="get" style="display: inline;">
                        <input type="hidden" name="action" value="show_update_course">
                        <input type="hidden" name="course_id" value="<?= $course['courseID'] ?>">
                        <button type="submit" class="edit-button">Edit</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
<?php else : ?>
    <p>No Courses exist yet</p>
<?php endif; ?>

<!-- Add Course Form -->
<section>
    <h2>Add Course</h2>
    <form action="." method="post" id="add__form" class="add_course_form">
        <input type="hidden" name="action" value="add_course">
        <div class="add__inputs">
            <label>Name:</label>
            <input type="text" name="course_name" maxlength="30" placeholder="Name" autofocus required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>

<p><a href=".?action=list_assignments">View/Edit Assignments</a></p>

<?php include("view/footer.php"); ?>