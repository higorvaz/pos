
var app = angular.module('myApp', []);

app.controller('PosController',['$scope', '$http', function ($scope,$http) {
   //Login  Register
    $scope.closeMsg = function(){
        $scope.alertMsg = false;
    };

    $scope.login_form = true;

    $scope.showRegister = function(){
        $scope.login_form = false;
        $scope.register_form = true;
        $scope.alertMsg = false;
    };

    $scope.showLogin = function(){
        $scope.register_form = false;
        $scope.login_form = true;
        $scope.alertMsg = false;
    };

    $scope.submitRegister = function(){
        $http({
            method:"POST",
            url:"register.php",
            data:$scope.registerData
        }).success(function(data){
            $scope.alertMsg = true;
            if(data.error != '')
            {
                $scope.alertClass = 'alert-danger';
                $scope.alertMessage = data.error;
            }
            else
            {
                $scope.alertClass = 'alert-success';
                $scope.alertMessage = data.message;
                $scope.registerData = {};
            }
        });
    };
    $scope.submitLogin = function(){
        $http({
            method:"POST",
            url:"login.php",
            data:$scope.loginData
        }).success(function(data){
            if(data.error != '')
            {
                $scope.alertMsg = true;
                $scope.alertClass = 'alert-danger';
                $scope.alertMessage = data.error;
            }
            else
            {
                location.reload();
            }
        });
    };
//Load Categories Drop Down Select
    $scope.loadCategory = function(){
        $http.get("ajax/getCategory.php")
            .success(function(data){
                $scope.categories = data;
            })
    };
    $scope.loadState = function(){
        $scope.$emit('LOAD');
        $http.post("ajax/getProducts.php", {'cat_id':$scope.cate})
            .success(function(data){
                $scope.productz = data;
                $scope.$emit('UNLOAD');
            });
    };
    $scope.$emit('LOAD');
    $http.get("ajax/resently.php").success(function (data) {
        $scope.drinker = data;
        $scope.$emit('UNLOAD');
    });
    $scope.$on('LOAD',function(){$scope.loading=true});
    $scope.$on('UNLOAD',function(){$scope.loading=false});

    $scope.order = [];
    $scope.new = {};

    $scope.getDate = function () {
        var today = new Date();
        var mm = today.getMonth() + 1;
        var dd = today.getDate();
        var yyyy = today.getFullYear();
        var date = dd + "/" + mm + "/" + yyyy;

        return date
    };
    this.NewCategory = function() {
        var categ_Data='categName=' +this.inputData.categ;
        $http({
            method: 'POST',
            url: 'newCategory.php',
            data: categ_Data,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(data) {
                console.log(data);
                if ( data.trim() === 'success') {
                    $('#category').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    window.location.reload();
                } else if ( data.trim()==='No Inserted'){
                    $scope.errorsms = "Category Name Not Inserted. Please Try Again.";
                }else {$scope.errorsms='Some Problem Has Occur Please Try Again.'}
            });
    };
    this.NewProduct= function() {
        var insertPrdt='catg=' +$scope.catg+'&prdName='+this.inputData.prodt+'&price='+this.inputData.price;
        $http({
            method: 'POST',
            url: 'newProduct.php',
            data: insertPrdt,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(data) {
           alert(data)
            $('#product').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            window.location.reload();
        });
    };
    $scope.addToOrder = function (products,qty) {
        $scope.Thx = [];
        $scope.Thx=products.id;
        var flag = 0;
        if ($scope.order.length > 0) {
            for (var i = 0; i < $scope.order.length; i++) {
                if (products.id === $scope.order[i].id) {
                    $scope.Thx=[];
                    $scope.MM=[];
                    $scope.namal=[];
                    $scope.pRz=[];
                    products.qty += qty;
                    for (var  i=0;i<$scope.order.length;i++){
                        $scope.Thx.push($scope.order[i].id);
                        $scope.MM.push($scope.order[i].qty);
                        $scope.namal.push($scope.order[i].name);
                        $scope.pRz.push($scope.order[i].price);
                    }
                    flag = 1;
                    break;
                }
            }
            if (flag === 0){
                products.qty = 1;

            }
            if (products.qty < 2) {
                $scope.Thx=[];
                $scope.MM=[];
                $scope.namal=[];
                $scope.pRz=[];
				$scope.order.push(products);
                for (var  i=0;i<$scope.order.length;i++){
                    $scope.Thx.push($scope.order[i].id);
                    $scope.MM.push($scope.order[i].qty);
                    $scope.namal.push($scope.order[i].name);
                    $scope.pRz.push($scope.order[i].price);
                }
            }
        } else {
            products.qty = qty;
            $scope.order.push(products);
            $scope.MM=[];
            $scope.namal=[];
            $scope.pRz=[];
            $scope.MM=products.qty;
            $scope.namal=products.name;
            $scope.pRz=products.price;

        }
    };
    $scope.removeProducts = function (products) {
        for (var i = 0; i < $scope.order.length; i++) {
            if (products.id === $scope.order[i].id) {
                $scope.Thx.splice(i,1);
                $scope.MM.splice(i,1);
                $scope.namal.splice(i,1);
                $scope.order.splice(i, 1);
            }
        }
    };
    $scope.getTotal = function () {
        var tot = 0;
        for (var i = 0; i < $scope.order.length; i++) {
            tot += ($scope.order[i].price * $scope.order[i].qty)
        }
        return tot;
    };
    $scope.clearOrder = function () {
        $scope.order = [];
    };
    $scope.checkout = function () {
        alert($scope.getDate()+ "\n\n Total amount: TSH" + $scope.getTotal().toFixed(2) + "\n\nPayment received. Thanks.");
        $scope.order = [];
    };
}]);