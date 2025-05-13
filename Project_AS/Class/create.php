<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
<script>
  const payload = {
    subjectName: "Math",
    subjectCode: "MATH101",
    section: "A",
    startTime: "08:00 AM",
    endTime: "10:00 AM",
    days: ["MON", "WED", "FRI"].join(",")
  };

  fetch('create_class_api.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(payload)
  })
  .then(res => res.json())
  .then(data => {
    if (data.status === "success") {
      alert(data.message); // Show alert if success
    } else {
      alert("Error: " + data.message); // Show error if status is not success
    }
    console.log(data);
  })
  .catch(err => {
    console.error(err);
    alert("An error occurred while creating the class.");
  });
</script>

</body>
</html>