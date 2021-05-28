import { AJAX_REQUEST } from './util.js';

export function addAssignment(event) {
    event.preventDefault();

    var name = document.getElementById("assignment_name").value;
    var description = document.getElementById("assignment_desc").value;
    var deadline = document.getElementById("deadline").value;

    var payload = "add=1&assignment_name=" + name + "&assignment_desc=" + description + "&assignment_deadline=" + deadline;

    var btn = document.getElementById('submitbtn');
    btn.disabled = true;

    AJAX_REQUEST('POST', 'create_assignment', payload, false).then(

        data => { alert('Added Successfully!') },
        error => { alert('An Error Has Occured, Try again later.') }
    );
}