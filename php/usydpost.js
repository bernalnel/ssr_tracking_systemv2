function usydpost(category, priority, risk, sdescription, start, end, usydno) {

    var requestBody = "{\"category\":\"" + category + "\",\"priority\":\"" + priority + "\",\"risk\":\"" + risk + "\",\"short_description\":\"" + sdescription +
        "\",\"start_date\":\"" + start + "\",\"end_date\":\"" + end + "\"}";

    var client = new XMLHttpRequest();
    client.open("post", "https://dev95245.service-now.com/api/sn_chg_rest/change/normal");

    client.setRequestHeader('Accept', 'application/json');
    client.setRequestHeader('Content-Type', 'application/json');

    //Eg. UserName="admin", Password="admin" for this code sample.
    client.setRequestHeader('Authorization', 'Basic ' + btoa('admin' + ':' + 'Passw0rd.'));

    client.onreadystatechange = function() {
        if (this.readyState == this.DONE) {
            //document.getElementById("response").innerHTML = this.status + this.response;
            var res = this.response;
            parsedData = JSON.parse(res);

            var number = parsedData.result.number.display_value;

            $.ajax({
                url: './usydpost.php',
                type: 'POST',
                data: { 'usydno': usydno, 'number': number },
                success: function(response) {
                    //do whatever
                }
            });
        }
    };
    client.send(requestBody);

}