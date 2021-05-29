var ajax = new XMLHttpRequest();
ajax.open("GET", "./php/fetch_assignments.php", true);
ajax.send();

ajax.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        var data = JSON.parse(this.responseText);
        console.log(data);


        var assignments_list = document.getElementById("assignments_list");

        for (var a = 0; a < data.length; a++) {

            const id = data[a].id;
            var assignmentName = data[a].name;

            var assignment = document.createElement('li');

            var link = document.createElement('a');
            link.href = "./upload_assignment_submission.html?id=" + id;
            link.innerHTML = assignmentName;

            assignment.appendChild(link);
            assignments_list.appendChild(assignment);

        }

    }
};