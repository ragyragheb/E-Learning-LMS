export const onClick = () => {
    console.log("h");
}

export const AJAX_REQUEST =  (type,endpoint,payload,file_upload)=> {
    return new Promise(function (resolve, reject) {
        const objXMLHttpRequest = new XMLHttpRequest();
        
        objXMLHttpRequest.onload = function () {
            if (objXMLHttpRequest.status == 200) {
                resolve(objXMLHttpRequest.responseText);
            } else {
                reject('Error Code: ' +  objXMLHttpRequest.status + ' Error Message: ' + objXMLHttpRequest.statusText);
            }
        }
        objXMLHttpRequest.onerror = function () {
            reject('Error Code: ' +  objXMLHttpRequest.status + ' Error Message: ' + objXMLHttpRequest.statusText);
        }
 
        objXMLHttpRequest.open(type, 'php/'+endpoint+'.php', true);
        if(file_upload){
            objXMLHttpRequest.setRequestHeader("Content-type","multipart/form-data");
        }else{
            objXMLHttpRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        }
        objXMLHttpRequest.send(payload);
    });
}