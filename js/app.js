var app = angular.module("fone_web", []);

var url_default = "http://intranet.sapiranga.rs.gov.br/fone_web/";

app.controller("contacts", function($scope, $http) {
  $scope.form = {};

  $scope.get_info_contact = function(id) {
    $http({
      method: "POST",
      url: "contacts/get_contact_by_id/",
      data: id
    }).then(
      function successCallback(response) {
        $scope.info_contact = response.data;
      },
      function errorCallback(response) {}
    );
  };

  $scope.edit_info_contact = function(id) {
    $http({
      method: "POST",
      url: "contacts/get_contact_by_id/",
      data: id
    }).then(
      function successCallback(response) {
        $scope.info_contact = response.data;
      },
      function errorCallback(response) {}
    );
  };

  $scope.get_contacts = function() {
    if ($scope.form.typed.length >= 3) {
      $http({
        method: "POST",
        url: "contacts/get_contacts/",
        data: $scope.form.typed
      }).then(
        function successCallback(response) {
          $scope.contacts = response.data;
        },
        function errorCallback(response) {}
      );
    }else{
      $scope.contacts = [];
    }
  };

  $scope.get_contacts_view = function() {
    if ($scope.form.typed.length >= 3) {
      $http({
        method: "POST",
        url: "get_contacts/",
        data: $scope.form.typed
      }).then(
        function successCallback(response) {
          $scope.contacts = response.data;
        },
        function errorCallback(response) {}
      );
    }
  };
  // $scope.submit_form = function (is_valid) {
  //     if (is_valid) {
  //         $http({
  //             method: 'POST',
  //             url: 'save_ldap',
  //             data: $scope.ldap
  //         }).then(function successCallback(response) {
  //             if (response.data) {
  //                 alert('OK');
  //             } else {
  //                 alert('NO');
  //             }
  //         }, function errorCallback(response) {
  //             alert('NO');
  //         });
  //     }
  // };
});

app.controller("new_contact", function($scope, $http, $location) {
  $scope.input_department = true;

  $scope.get_departments = function(){
    $scope.input_department = true;
    $http({
      method: "GET",
      url: "../departments/get_all/" + $scope.secretary,
    }).then(
      function successCallback(response) {
        $scope.input_department = false;
        $scope.departments = response.data;
      },
      function errorCallback(response) {}
    );
  };
});

app.controller("update_contact", function($scope, $http, $location) {
  $scope.secretary = document.getElementById('secretary_selected').value;
  $scope.departament_selected = document.getElementById('department_selected').value;

  $scope.get_departments = function(){
    $http({
      method: "GET",
      url: "../../departments/get_all/" + $scope.secretary,
    }).then(
      function successCallback(response) {
        $scope.departments = response.data;
      },
      function errorCallback(response) {}
    );
  };
  $scope.get_departments();
});

app.controller("users", function($scope, $http, $location) {
  //   $scope.info_user = {};

  $scope.get_user_by_id = function(id) {
    $http({
      method: "POST",
      url: url_default + "users/get_user_by_id/",
      data: id
    }).then(
      function successCallback(response) {
        $scope.info_user = response.data;
        // $scope.get_permission_user_by_id();
      },
      function errorCallback(response) {}
    );
  };

  $scope.get_permission_user_by_id = function(id) {
    $http({
      method: "POST",
      url: url_default + "users/get_permission_user_by_id/",
      data: id
    }).then(function successCallback(response) {
      $scope.permissions = response.data;
      // console.log(response.data);
      // console.log($location.absUrl());
    });

    // $scope.permissions = [
    //   "Alfreds Futterkiste",
    //   "Berglunds snabbköp",
    //   "Centro comercial Moctezuma",
    //   "Ernst Handel"
    // ];
  };
});
