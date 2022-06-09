<?php include "parts/_header.php" ?>
<main>
    <h2>Add Student</h2>
    <form action="process.php" method="post">
        <table class="edit-table">
            <tbody>
                <tr>
                    <td>Personal Photo</td>
                    <td><input type="file" name="photo" alt="brwose for photo" accept="image/*" /></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><input class="text-field-major" type="text" name="name" alt="insert name"/></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>
                        <select name="city">
                            <option>Select City</option>
                            <option>Birzeit</option>
                            <option>Jeruselem</option>
                            <option>Nablus</option>
                            <option>Hebron</option>
                            <option>Jenin</option>
                            <option>Ramallah</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input class="text-field-major" type="email" name="email" alt="insert email"/></td>
                </tr>
                <tr>
                    <td>Tel</td>
                    <td><input class="text-field-major" type="tel" name="tel" alt="insert phone number"/></td>
                </tr>
                <tr>
                    <td>University</td>
                    <td><input class="text-field-major" type="text" name="university" alt="insert university"/></td>
                </tr>
                <tr>
                    <td>Major</td>
                    <td><input class="text-field-major" type="text" name="major" alt="insert major"/></td>
                </tr>
                <tr>
                    <td>Projects</td>
                    <td><textarea></textarea></td>
                </tr>
                <tr>
                    <td>Interests</td>
                    <td><textarea></textarea></td>
                </tr>
            </tbody>
        </table>
        <div class="add-clear-div">
            <input type="submit" value="Add Student"/>
            <input type="reset" value="Clear"/>
        </div>
    </form>
    <a class="link-table" id="cancle-student-link" href="students.php">Cancle and return to Students List</a>
    <aside>
        <h2>Help</h2>
        <p>
            Add your student details including projects and interests so that companies can select you...
        </p>
    </aside>
</main>
<?php include "parts/_footer.php" ?>

