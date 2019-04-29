INSERT INTO dog_listings
(
    dogName,
    breed,
	gender,
	DogDesc,
    age,
    DatePosted,
	userID)
VALUES
	( 'Hank', 'Boxer', 'Male', 'Brown 6 year old boxer', 6, CURDATE(), 1),
	( 'Duncan', 'Terrier', 'Male','white 10 year old west highland terrier', 10, CURDATE(), 1),
	( 'Daisy', 'Terrier', 'Female', 'white 8 year old west highland terrier', 8, CURDATE(), 2),
	( 'Bailey', 'Yorkshire Terrier', 'Female', 'brown and black 5 ear old yorkshire terrier', 5, CURDATE(), 3),
	( 'Bruce', 'Pug', 'Male','white 2 year old pug', 2, CURDATE(), 6),
	( 'Macy', 'Labrador', 'Female', 'white 3 year old Labrador, trained as an emotional support animal', 3, CURDATE(), 5),
	( 'Ricky', 'Chihuaua', 'Male', 'white 7 year old Chiuaua with napoleanic syndrome', 7, CURDATE(), 1),
	( 'Hotrod', 'Great Dane', 'Male', 'black 1 year old Great Dane,  6''4 240lbs',1, CURDATE(), 2);