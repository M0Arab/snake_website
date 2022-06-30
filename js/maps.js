/**
 * @license
 * Copyright 2019 Google LLC. All Rights Reserved.
 * SPDX-License-Identifier: Apache-2.0
 */
let map;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 5.872733024984666, lng: -55.20990780123901 },
        zoom: 12,
    });
    const image = "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png";
    const beachMarker = new google.maps.Marker({
        position: { lat:5.85131532809372 , lng: -55.201872372886534 },
        map: map,
        icon: image,
    });

}

window.initMap = initMap;
