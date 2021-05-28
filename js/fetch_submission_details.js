var ajax = new XMLHttpRequest();
ajax.open("POST", "./php/fetch_submission_details.php", true);
const urlParams = new URLSearchParams(window.location.search);
const submission_id = urlParams.get('id');
var params = "id=" + submission_id;
ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
ajax.send(params);


ajax.onreadystatechange = function () { //Call a function when the state changes.
    if (this.readyState == 4 && this.status == 200) { // complete and no errors
        var data = JSON.parse(this.responseText);
        console.log(data);

        var student_name = document.getElementById("student_name");
        student_name.textContent = data.student_name;

        var submission_time = document.getElementById("submission_time");
        submission_time.textContent = data.submission_time;

        //link to open submission
        var submission_file = document.getElementById("file");
        submission_file.href = "http://localhost/E-Learning-LMS/php/" + data.assignment_dir;
        submission_file.textContent = "See submission";


        //Update student grade
        var save_button = document.getElementById("save_button");
        save_button.onclick = function (e) {
            e.preventDefault();
            var grade = document.getElementById("assignm_grade").value;
            var id = data.id;
            var ajax = new XMLHttpRequest();
            ajax.open("POST", "./php/fetch_submission_details.php", true);
            var params = "submission_id=" + id + "&grade=" + grade;
            ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajax.send(params);
            ajax.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    alert("Grade Updated!");
                }
            }
        }
    }
};







