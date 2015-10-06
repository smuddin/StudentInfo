/**
 * Created by Arif Uddin on 10/5/2015.
 */

var stdInfoApp = angular.module('studentInfoApp', []);
stdInfoApp.controller('studentController', function($scope, $http) {
    $http({
        method: 'GET',
        url: 'http://localhost:8080/pet-projects/student-info-php-oop/api/get-students.php'
    }).then(function successCallback(response) {
        // this callback will be called asynchronously
        // when the response is available
        // console.log(response);
        $scope.studentList = response.data;

    }, function errorCallback(response) {
        // called asynchronously if an error occurs
        // or server returns response with an error status.
    });
});