<h1>Login</h1>
<form action="#" method="post">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Your email..." required>
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Your password..." required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php if (isset($error_value)) : ?>
    <?php if ($error_value == "nodata") : ?>
        <p style="color: orangered;">Please, fill the field with your information.</p>
    <?php elseif ($error_value == "email") : ?>
        <p style="color: orangered;">This email is not valid.</p>

    <?php elseif ($error_value == "pwd") : ?>
        <p style="color: orangered;">This password is not valid.</p>

    <?php elseif ($error_value == "nodb") : ?>
        <p style="color: orangered;">This user doesn't exist.</p>

    <?php endif; ?>
<?php endif; ?>