function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition,error,options);
    } else {
        alert("Geolocation is not supported by this browser, your observation will not hold the location");
    }
}

const options = {
    enableHighAccuracy: true,
    maximumAge: 30000,
    timeout: 27000
};

function showPosition(position) {
    document.getElementById("location").value = position.coords.latitude + "::" + position.coords.longitude;

    var geocoder = new google.maps.Geocoder();

    var lat = position.coords.latitude;
    var lng = position.coords.longitude;


    var latlng = new google.maps.LatLng(lat, lng);

    geocoder.geocode({'latLng': latlng}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[1]) {
                cityFound = false;
                streetNrFound = false;
                streetNameFound = false;

                for (var i=0; i<results[0].address_components.length; i++) {
                    for (var b=0;b<results[0].address_components[i].types.length;b++) {
                        //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                        if (!cityFound && results[0].address_components[i].types[b] == "locality") {
                            //this is the object you are looking for
                            city= results[0].address_components[i];
                            cityFound = true;
                            }

                        if (!streetNrFound && results[0].address_components[i].types[b] == "street_number") {
                            //this is the object you are looking for
                            streetNumber= results[0].address_components[i];
                            streetNrFound = true;
                            }

                        if (!streetNameFound && results[0].address_components[i].types[b] == "route") {
                            //this is the object you are looking for
                            streetName= results[0].address_components[i];
                            streetNameFound = true;
                        }

                        if (cityFound && streetNrFound && streetNameFound) break;
                    }
                }
/*
                city = results[0].address_components[2];
                streetName = results[0].address_components[1];
                streetNumber = results[0].address_components[0];
*/

                document.getElementById("location_address").value = city.long_name + " " + streetName.long_name + " " + streetNumber.long_name;

            } else {
                //alert("No results found");
            }
        } else {
            //alert("Geocoder failed due to: " + status);
        }
    });
}

function error(err){
    //alert("Couldn't get location: " + `ERROR(${err.code}): ${err.message}`);
}
