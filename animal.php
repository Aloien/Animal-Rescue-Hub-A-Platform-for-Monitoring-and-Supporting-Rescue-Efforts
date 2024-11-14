<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Forms</title>
</head>
<h2>Add Animals</h2>
<body>
    <form>
    <div>
        <label for="aname">Name:</label>
        <input type="text" name="aname" id="aname" placeholder="Alen" required>
    </div>
    <br>
    <div>
        <label for="species">Species:</label>
        <input type="text" name="species" id="species" placeholder="Azkal" required>
    </div>
    <br>
    <div>
        <label for="age">Age:</label>
        <input type="text" name="age" id="age" placeholder="13" required>
    </div>
    <br>
    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description" cols="20" rows="5" placeholder="Write the animal description here!"></textarea>
    </div>
    <br>
    <div>
        <label for="photo">Animal Photo:</label>
        <input type="file" name="photo" id="photo" accept="image/png, image/jpeg">
    </div>
    <br>
    <div>
        <input type="submit">
    </div>

    </form>
</body>
</html>