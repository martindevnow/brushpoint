<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Feedback Received</title>
</head>
<body>
  <h1>New Product Feedback Received</h1>

  <p><b>Name: </b> {{ $name }}</p>
  <p><b>Email: </b>{{ $email }}</p>
  <p><b>Phone: </b>{{ $phone }}</p>
  <p><b>Retailer: </b>{{ $retailer }}</p>
  <p><b>Lot Code: </b>{{ $lot_code }}</p>
  <p><b>Issue: </b>{{ $issue }}</p>

  <p>Visit {{ link_to('admins/feedback/' $id) }} to view and respond to/update this feedback.</p>

  <p>You may also reply directly to this email.</p>
</body>
</html>