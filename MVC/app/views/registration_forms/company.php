<h1>Register as a Company</h1>
<form method="POST" enctype="multipart/form-data">
    <div class="input-field">
        <label for="companyName">Enter Company Name</label>
        <input
            type="text"
            placeholder="Company name"
            name="companyName"
            required
            value="<?= isset($_POST['companyName']) ? htmlspecialchars($_POST['companyName']) : '' ?>">
    </div>

    <div class="input-field">
        <label for="email">Enter Company Email</label>
        <input
            type="email"
            placeholder="Company email"
            name="email"
            required
            value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
            style="<?= !empty($errors['email']) ? 'border: 2px solid red;' : '' ?>">

        <?php if (!empty($errors['email'])): ?>
            <div style="color:red;" class="error"><?= $errors['email'] ?></div>
        <?php endif; ?>
    </div>

    <div class=input-field>
        <label for="contactNo">Enter Contact Number</label>
        <input
            type="tel"
            placeholder="Contact number ex: 071 888 8888"
            name="contactNo"
            pattern="[0-9]{10}"
            required>

    </div>

    <div class="input-field">
        <label for="hr_firstName">HR Manager First Name</label>
        <input
            type="text"
            placeholder="First name of HR Manager"
            name="hr_firstName"
            required
            value="<?= isset($_POST['hr_firstName']) ? htmlspecialchars($_POST['hr_firstName']) : '' ?>">
    </div>

    <div class="input-field">
        <label for="hr_lastName">HR Manager Last Name</label>
        <input
            type="text"
            placeholder="Last name of HR Manager"
            name="hr_lastName"
            required
            value="<?= isset($_POST['hr_lastName']) ? htmlspecialchars($_POST['hr_lastName']) : '' ?>">
    </div>

    <div class="input-field">
        <label for="hr_email">HR Contact Email</label>
        <input
            type="email"
            placeholder="HR contact email"
            name="hr_email"
            required
            value="<?= isset($_POST['hr_email']) ? htmlspecialchars($_POST['hr_email']) : '' ?>">
    </div>

    <div class="input-field">
        <label for="hr_contactNo">HR Contact Number</label>
        <input
            type="tel"
            placeholder="HR contact number ex: 0718888888"
            name="hr_contactNo"
            pattern="[0-9]{10}"
            required>
    </div>

    <div class="input-field">
        <label for="business_certificate">Business Registration Certificate</label>
        <input
            type="file"
            name="business_certificate"
            accept=".pdf,.jpg,.jpeg,.png"
            required>
    </div>

    <div class=input-field>
        <label for="password">Enter Password</label>
        <input
            type="password"
            placeholder="Password"
            name="password"
            required>
    </div>

    <div class="input-field">
        <label for="confirm_password">Re-enter the Pasword</label>
        <input
            type="password"
            placeholder="Confirm Password"
            name="confirm_password"
            required
            style="<?= !empty($errors['confirm_password']) ? 'border: 2px solid red;' : '' ?>">
        <?php if (!empty($errors['confirm_password'])): ?>
            <div style="color:red; padding-bottom:15px;" class="error"><?= $errors['confirm_password'] ?></div>
        <?php endif; ?>
    </div>

    <button type="submit">Register</button>
</form>