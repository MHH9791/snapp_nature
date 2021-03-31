let map,pos,infoWindow,xhr,markers;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {zoom: 16});
    infoWindow = new google.maps.InfoWindow();
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                //infoWindow.setPosition(pos);
                //infoWindow.setContent("You are here!");
                //infoWindow.open(map);
                markers = [
                    {
                        coords: pos,
                        title: "You are here!",
                        content: "You are here!",
                        iconImage:{
                            url: '../../Assets/PositionMarker.png',
                            scaledSize: new google.maps.Size(50, 50) //scale size of icon to 50%
                        }
                    }
                ];
                map.setCenter(pos);
            },
            () => {
                handleLocationError(true, infoWindow, map.getCenter());
            }
        );
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(
            browserHasGeolocation
                ? "Error: The Geolocation service failed."
                : "Error: Your browser doesn't support geolocation."
        );
        infoWindow.open(map);
    }

    //Add example markers
    /*var markers = [
        {
            coords: {lat:50.874986,lng:4.707685},
            title: "Groep T",
            content: '<h1 id="firstHeading" class="firstHeading">Groep T</h1>' +
                '<div id="bodyContent">' +
                "<p><b>Group T</b> (Groep T) is a college (formerly hogeschool (college)) in Leuven," +
                " Belgium. The school was formed by a fusion of an existing school for technical (industrial) engineers " +
                "and the Provinciale Normaalschool. Nowadays the school offers two main branches:" +
                "<ul>" +
                "<li><b>The Engineering College:</b> a Bachelor and Master in industrial sciences.</li>\n" +
                "<li><b>The Teacher's College:</b> a Bachelor of education.</li>\n" +
                "</ul>" +
                "Apart from this, Group T has built a considerable reputation for adult education (social promotion). " +
                "The school has always emphasized its independence from other educational institutions in Belgium. " +
                "This is the main reason it has not joined the KHL (Katholieke Hogeschool Leuven) when that was formed.</p>" +
                '<p>Attribution: Groep T, <a href="https://en.wikipedia.org/wiki/Groep_T">' +
                "https://en.wikipedia.org/wiki/Groep_T</a></p>" +
                "</div>" +
                "</div>"
        },
        {
            coords: {lat: 50.87959, lng: 4.70093},
            title: "Church Chair", //Optional, just shows the name of you hover over it with mouse
            content: '<b>Church Chair</b> (extremely rare)'
        }
    ];*/

    xhr = new XMLHttpRequest()
    xhr.onreadystatechange = myCallback
    xhr.open("GET", "https://a20ux5.studev.groept.be/activity_nearby_map?output=json", true)
    xhr.send()

    function myCallback() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var data=xhr.responseText;
                var jsonResponse = JSON.parse(data);
                for (var i = 0; i<Object.keys(jsonResponse).length; i++) {
                    if(jsonResponse[i]["coordinate"]){
                        var latlng = jsonResponse[i]["coordinate"].split("::",2);
                        var newMarker = {
                            coords: {lat: parseFloat(latlng[0]), lng: parseFloat(latlng[1])},
                            title: jsonResponse[i]["common_name"], //Optional, just shows the name of you hover over it with mouse
                            content: "<div style='float:left'>" +
                                    "<img src='" + jsonResponse[i]["picture"] + "'style=\"width:72px;height:72px;\">" +
                                "</div>" +
                                "<div style='margin-left: 82px;'>" +
                                    "<h6>" + jsonResponse[i]["common_name"] + "</h6>" +
                                    "<p>Also known as " + jsonResponse[i]["scientific_name"] +
                                    "</p>Added by: <a href='https://a20ux5.studev.groept.be/profile_page/" + jsonResponse[i]["iduser"] + "'>" +
                                        jsonResponse[i]["username"] + "</a> (" + jsonResponse[i]["time"] + ")" +
                                "</div>"
                        };
                        markers.push(newMarker);
                    }
                }
                //console.log(markers);
                for(var i=0; i<markers.length; i++){
                    addMarker(markers[i]);
                }
            } else {
                //alert("Message returned, error status: " +  xhr.status + ".");
            }
        }
    }

    function addMarker(props){
        var marker = new google.maps.Marker({
            position:props.coords,
            map,
            title:props.title
        });
        if(props.iconImage){
            marker.setIcon(props.iconImage);
        } else {
            marker.setIcon({
                url: '../../Assets/icons/pin%20simple%20map.svg',
                scaledSize: new google.maps.Size(40, 40) //scale size of icon to 40%
            });
        }
        if(props.content){
            var infoWindow = new google.maps.InfoWindow({
                content: props.content
            });
            marker.addListener('click',function(){
                infoWindow.open(map, marker);
            })
        }
    }
}