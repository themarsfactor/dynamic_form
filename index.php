<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Weight Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .removeButton {
            cursor: pointer;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Dynamic Weight Form</h2>
        <table class="table table-bordered" id="weightTable">
            <thead class="thead-light">
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Weight (kg)</th>
                    <th>Length (cm)</th>
                    <th>Width (cm)</th>
                    <th>Height (cm)</th>
                    <th>Volume Weight (kg)</th>
                    <th>Greater Weight</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="form-control description" placeholder="Enter description" /></td>
                    <td><input type="number" class="form-control amount" value="1" min="1" /></td>
                    <td><input type="number" class="form-control weight" oninput="calculateVolumeWeight(this)" /></td>
                    <td><input type="number" class="form-control length" oninput="calculateVolumeWeight(this)" /></td>
                    <td><input type="number" class="form-control width" oninput="calculateVolumeWeight(this)" /></td>
                    <td><input type="number" class="form-control height" oninput="calculateVolumeWeight(this)" /></td>
                    <td><input type="number" class="form-control volumeWeight" readonly /></td>
                    <td><input type="number" class="form-control greaterWeight" readonly /></td>
                    <td><span class="removeButton" onclick="removeRow(this)">X</span></td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-primary mb-3" onclick="addRow()">Add Row</button>
        <div class="row">
            <div class="col-md-6">
                <h3>Total Weight: <span id="totalWeight">0</span> kg</h3>
            </div>
            <div class="col-md-6">
                <h3>Total Price: $<span id="totalPrice">0</span></h3>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script>
        function calculateVolumeWeight(element) {
            const row = element.closest('tr');
            const weight = parseFloat(row.querySelector('.weight').value) || 0;
            const length = parseFloat(row.querySelector('.length').value) || 0;
            const width = parseFloat(row.querySelector('.width').value) || 0;
            const height = parseFloat(row.querySelector('.height').value) || 0;
            const amount = parseFloat(row.querySelector('.amount').value) || 1;

            const volumeWeight = (length * width * height) / 5000; // Volume weight formula

            row.querySelector('.volumeWeight').value = volumeWeight.toFixed(2);

            const greaterWeight = Math.max(weight, volumeWeight) * amount;
            row.querySelector('.greaterWeight').value = greaterWeight.toFixed(2);

            calculateTotalWeight();
        }

        function calculateTotalWeight() {
            let totalWeight = 0;
            const rows = document.querySelectorAll('#weightTable tbody tr');

            rows.forEach(row => {
                const greaterWeight = parseFloat(row.querySelector('.greaterWeight').value) || 0;
                totalWeight += greaterWeight;
            });

            document.getElementById('totalWeight').innerText = totalWeight.toFixed(2);
            calculateTotalPrice(totalWeight);
        }

        function calculateTotalPrice(totalWeight) {
            const pricePerKg = 6;
            const totalPrice = totalWeight * pricePerKg;
            document.getElementById('totalPrice').innerText = totalPrice.toFixed(2);
        }

        function addRow() {
            const table = document.getElementById('weightTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();

            const cell1 = newRow.insertCell(0);
            const cell2 = newRow.insertCell(1);
            const cell3 = newRow.insertCell(2);
            const cell4 = newRow.insertCell(3);
            const cell5 = newRow.insertCell(4);
            const cell6 = newRow.insertCell(5);
            const cell7 = newRow.insertCell(6);
            const cell8 = newRow.insertCell(7);
            const cell9 = newRow.insertCell(8);

            cell1.innerHTML = '<input type="text" class="form-control description" placeholder="Enter description" />';
            cell2.innerHTML = '<input type="number" class="form-control amount" value="1" min="1" />';
            cell3.innerHTML = '<input type="number" class="form-control weight" oninput="calculateVolumeWeight(this)" />';
            cell4.innerHTML = '<input type="number" class="form-control length" oninput="calculateVolumeWeight(this)" />';
            cell5.innerHTML = '<input type="number" class="form-control width" oninput="calculateVolumeWeight(this)" />';
            cell6.innerHTML = '<input type="number" class="form-control height" oninput="calculateVolumeWeight(this)" />';
            cell7.innerHTML = '<input type="number" class="form-control volumeWeight" readonly />';
            cell8.innerHTML = '<input type="number" class="form-control greaterWeight" readonly />';
            cell9.innerHTML = '<span class="removeButton" onclick="removeRow(this)">X</span>';
        }

        function removeRow(element) {
            const row = element.closest('tr');
            row.parentNode.removeChild(row);
            calculateTotalWeight();
        }
    </script>
</body>
</html>
