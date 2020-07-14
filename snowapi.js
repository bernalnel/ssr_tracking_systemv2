function snowapi() {

    //var requestBody = "{\"assignment_group\":\"Wintel\",\"short_description\":\"Decommision of servers\"}"; 

    var agroup = document.getElementById("agroup").value;                   //Assign to variable the input from html file
    var sdescription = document.getElementById("sdescription").value;

    var requestBody = "{\"short_description\":\"" + sdescription + "\",\"assignment_group\":\"" + agroup + "\"}"


    var client=new XMLHttpRequest();
    client.open("post","https://dev93193.service-now.com/api/now/table/change_request");

    client.setRequestHeader('Accept','application/json');
    client.setRequestHeader('Content-Type','application/json');

    //Eg. UserName="admin", Password="admin" for this code sample.
    client.setRequestHeader('Authorization', 'Basic '+btoa('admin'+':'+'!QAZxsw2#EDCvfr4'));

    client.onreadystatechange = function() { 
        if(this.readyState == this.DONE) {
            //document.getElementById("response").innerHTML=this.status + this.response; 
            var res = this.response;
            parsedData = JSON.parse(res);
            alert("You have successfully created a change with number: " + parsedData.result.number);
        
        }
    }; 
    client.send(requestBody);

}