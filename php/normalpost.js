function normalpost(category, priority, risk, sdescription, start, end, dxcssr) {

    var requestBody = "{\"category\":\"" + category + "\",\"priority\":\"" + priority + "\",\"risk\":\"" + risk + "\",\"short_description\":\"" + sdescription +
        "\",\"start_date\":\"" + start + "\",\"end_date\":\"" + end + "\"}";

    var client = new XMLHttpRequest();
    client.open("post", "https://dev93193.service-now.com/api/sn_chg_rest/change/normal");

    client.setRequestHeader('Accept', 'application/json');
    client.setRequestHeader('Content-Type', 'application/json');

    //Eg. UserName="admin", Password="admin" for this code sample.
    client.setRequestHeader('Authorization', 'Basic ' + btoa('admin' + ':' + '!QAZxsw2#EDCvfr4'));

    client.onreadystatechange = function() {
        if (this.readyState == this.DONE) {
            //document.getElementById("response").innerHTML = this.status + this.response;
            var res = this.response;
            parsedData = JSON.parse(res);
            window.location.href = "./normalpost.php?dxcssr=" + dxcssr + "&sys_id=" + parsedData.result.sys_id.value + "&number=" + parsedData.result.number.value + "&state=New";
            //return [dxcssr, parsedData.result.sys_id.value, parsedData.result.number.value, "draft"];
        }
    };
    client.send(requestBody);

}