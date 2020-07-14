src = "http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js";

function normalget(sys_id) {
    var requestBody = "";

    var client = new XMLHttpRequest();
    client.open("get", "https://dev93193.service-now.com/api/sn_chg_rest/change/normal/" + sys_id);

    client.setRequestHeader('Accept', 'application/json');
    client.setRequestHeader('Content-Type', 'application/json');

    //Eg. UserName="admin", Password="admin" for this code sample.
    client.setRequestHeader('Authorization', 'Basic ' + btoa('admin' + ':' + '!QAZxsw2#EDCvfr4'));

    client.onreadystatechange = function() {
        if (this.readyState == this.DONE) {
            //document.getElementById("response").innerHTML = this.status + this.response;
            var res = this.response;
            parsedData = JSON.parse(res);



            var states = parsedData.result.state.display_value;

            $.ajax({
                url: './normalget.php',
                type: 'POST',
                data: { 'state': states, 'sys_id': sys_id },
                success: function(response) {
                    //do whatever
                }
            });


            //return parsedData.result.state.display_value;
            //window.location.href = "./normalget.php?sys_id=" + sys_id + "&state=" + parsedData.result.state.display_value;
            //return [dxcssr, parsedData.result.sys_id.value, parsedData.result.number.value, "draft"];
        }
    };
    client.send(requestBody);
}