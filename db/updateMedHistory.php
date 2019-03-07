$sth = $conn->prepare("INSERT INTO history(id, patient)
VALUES (:id, :patient)");
$sth->bindParam(':id', $id);
$sth->bindParam(':patient', $pid);
$sth->execute();