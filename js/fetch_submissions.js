import { AJAX_REQUEST } from './util.js';

export const getAssignments = () => AJAX_REQUEST('GET', 'fetch_submissions')
    .then(
        data => {
            var assignments = JSON.parse(data).assignments;
            for (var i = 0; i < assignments.length; i++) {
                //making an assignment card, and making a p (assignment name)
                var assignments_el = document.getElementById("assignments");
                var assignment_el = document.createElement('div');
                var title = document.createElement('p');
                var list = document.createElement('ul');

                //setting proper classes for each of the assignment card and the assignment name
                assignment_el.className = "CourseCard";
                title.className = "sign";

                //setting the name
                title.innerHTML = assignments[i].name;

                //looping thorugh each assignment list of submissions related to this assignment
                for (var j = 0; j < assignments[i].submissions.length; j++) {

                    //creating a link for the file and putting it in the li.
                    const id = assignments[i].submissions[j].id;
                    var item = document.createElement('li');
                    var link = document.createElement('a');

                    link.href = "./fetch_submission_details.html?id=" + id;
                    link.innerHTML = assignments[i].submissions[j].student_name + "'s submission";

                    // putting the item in the main list of submissions for the specified assignment
                    item.appendChild(link);
                    list.appendChild(item);
                }

                //putting title into the card
                assignment_el.appendChild(title);
                //putting submissions into the card
                assignment_el.appendChild(list);

                //putting assignment into the main div

                assignments_el.appendChild(assignment_el);
            }

        }
    );