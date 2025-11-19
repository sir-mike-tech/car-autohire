<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form action="insert_feedback.php" method="POST" name="form1">
  <label>Your Name:</label>
  <input type="text" name="yourname" required>

  <label>Organization:</label>
  <input type="text" name="organization" required>

  <label>Email:</label>
  <input type="email" name="email" required>

  <label>Message:</label>
  <textarea name="briefmessage" required></textarea>

  <input type="submit" value="Send Feedback">
</form>

</body>
</html>
