import {AJAX_REQUEST} from './util.js';

export const getAssignment = (id) => {
    const payload = "assignment_id="+id;
    AJAX_REQUEST('POST','fetch_assignment_by_id',payload,false)
                .then(
                    data => {
                        const assignment =  JSON.parse(data); //Parsing from a string JSON to an accessible JSON.
                        document.getElementById("assignment_name").append(assignment.name);
                        document.getElementById("assignment_deadline").append(assignment.deadline);
                    },
                    error => {
                        alert(JSON.parse(error).error);
                    }
                )
};

export const addSubmission = async (event,assignment_id) => {
    event.preventDefault();
    
    const formData = new FormData();
    const student_name = document.getElementById("student_name").value;
    const file = document.getElementById("file").files[0];
    formData.append("assignment_file",file);
    formData.append("student_name",student_name);
    formData.append("assignment_id",assignment_id);
    formData.append("submit",true);
    await fetch('php/submit_assignment.php',{
        method:'POST',
        body:formData
    });
    alert('The assignment has been uploaded successfully.');
};