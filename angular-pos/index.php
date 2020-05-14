<?php
session_start();
?>
<!DOCTYPE html>
<html ng-app="myApp">
<head>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css" />
    <link href="css/styles.css" rel="stylesheet"/>
</head>
<style>
    .form_style {
        width: 600px;
        margin: 0 auto;
    }.log:hover{color: #ffffff;text-decoration: none}
    .log{left: 32px;position: absolute}
</style>
<body ng-controller="PosController as angCtrl" ng-init="loadCategory()" style="margin-top: 25px">
<?php
 if(isset($_SESSION["name"]))
    {?>
        <div class="center">
                <fieldset>
                    <ul class="toolbar">
                        <li><button data-toggle="modal" data-target="#category"><span class="glyphicon-plus">&nbsp;Add New Category</span></button></li>
                        <li><button data-toggle="modal" data-target="#product"><span class="glyphicon-plus">&nbsp;Add New Product</span></button></li>
                        <li><a class="log" href="logout.php">LogOut</a></li>
                    </ul>
                    <li id="rib"><?php echo $_SESSION['name'];?></a></li>
                </fieldset>
        </div>
        <?php include 'trigger.php'?>
        <div class="col-md-12">
            <div class="row" style="margin-left: 35px;margin-top:4px;position: absolute">
                <div class="col-md-6">
                    <div class="panel panel-primary"style="min-width: 520px">
                        <div class="panel-body">
                            <ul id="myTab" class="nav nav-tabs active" role="tablist">
                                <select ng-model="cate" name="cate"  class="form-control" ng-change="loadState()" ng-options="cat.cat_id as cat.cat_name for cat in categories"required>
                                    <option value="">Random Selection</option>
                                </select>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active"name="state" ng-model="state" ng-if="productz">
                                    <button class="btn btn-primary btn-pos btn-marginTop" data-ng-repeat="products in productz" data-ng-bind="products.name" data-ng-click="addToOrder(products,1)"></button>
                                </div>
                                <div role="tabpanel" class="tab-pane active"ng-if="!productz">
                                    <button class="btn btn-warning btn-pos btn-marginTop" data-ng-repeat="item in drinker" data-ng-bind="item.name" data-ng-click="addToOrder(item,1)"></button>
                                </div>
                                <div role="tabpanel" class="tab-pane active"ng-show="loading">
                                    <button class="btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-primary"style="min-width: 600px">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-4"><span class="panel-title">Order Summary</span></div>
                                <div class="col-md-4"><span>Today is: {{getDate()}}</span></div>
                                <div class="col-md-3 col-md-push-1"><span>Total Orders - </span><span class="badge">{{totOrders}}</span></div>
                            </div>
                        </div>
                        <div class="panel-body" style="max-height:320px; overflow:auto;">
                            <div class="text-warning" ng-hide="order.length">
                                Nothing ordered yet!
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item" ng-repeat="products in order">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <span class="badge badge-left" ng-bind="products.qty"></span>
                                        </div>
                                        <div class="col-md-4">
                                            {{products.name}}
                                        </div>
                                        <div class="col-md-1">
                                            <div class="label label-success">{{products.price * products.qty | currency:"T sh":0}}</div>
                                        </div>
                                        <div class="col-md-1 col-md-push-1">
                                            <div class="label label-warning">{{products.price | currency:"T sh":0}}</div>
                                        </div>
                                        <div class="col-md-2 col-md-push-2">
                                            <span><strong><input style="background-color:#777777;color: white;width: 28px;border-radius: 8px;text-align: center;" type="number" ng-model="a"/></strong></span>
                                            <button class="btn btn-success btn-xs" ng-click="addToOrder(products,a)">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </div>
                                        <div class="col-md-1 col-md-push-2">
                                            <button class="btn btn-danger btn-xs" ng-click="removeProducts(products)">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="panel-footer" ng-show="order.length">
                             <h3><span class="label label-primary">Total: {{getTotal() | currency:"T sh ":0}}</span></h3>
                        </div>
                        <div class="panel-footer" ng-show="order.length">
                            <div>
                                <span class="btn btn-default btn-marginTop" ng-click="clearOrder()" ng-disabled="!order.length">Clear</span>
                                <span class="btn btn-danger btn-marginTop" ng-click="checkout()" ng-disabled="!order.length">Checkout</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }else{?>
     <div class="form_style">
    <div class="alert {{alertClass}} alert-dismissible" ng-show="alertMsg">
        <a href="#" class="close" ng-click="closeMsg()" aria-label="close">&times;</a>
        {{alertMessage}}
    </div>

    <div class="panel panel-default" ng-show="login_form">
        <div class="panel-heading">
            <h3 class="panel-title">Login</h3>
        </div>
        <div class="panel-body">
            <form method="post" ng-submit="submitLogin()">
                <div class="form-group">
                    <label>Enter Your Email</label>
                    <input type="text" name="email" ng-model="loginData.email" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Enter Your Password</label>
                    <input type="password" name="password" ng-model="loginData.password" class="form-control" />
                </div>
                <div class="form-group" align="center">
                    <input type="submit" name="login" class="btn btn-primary" value="Login" />
                    <br />
                    <input type="button" name="register_link" class="btn btn-primary btn-link" ng-click="showRegister()" value="Register" />
                </div>
            </form>
        </div>
    </div>

    <div class="panel panel-default" ng-show="register_form">
        <div class="panel-heading">
            <h3 class="panel-title">Register</h3>
        </div>
        <div class="panel-body">
            <form method="post" ng-submit="submitRegister()">
                <div class="form-group">
                    <label>Enter Your Name</label>
                    <input type="text" name="name" ng-model="registerData.name" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Enter Your Email</label>
                    <input type="text" name="email" ng-model="registerData.email" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Enter Your Password</label>
                    <input type="password" name="password" ng-model="registerData.password" class="form-control" />
                </div>
                <div class="form-group" align="center">
                    <input type="submit" name="register" class="btn btn-primary" value="Register" />
                    <br />
                    <input type="button" name="login_link" class="btn btn-primary btn-link" ng-click="showLogin()" value="Login" />
                </div>
            </form>
        </div>
    </div>
</div>
<?php }?>
</body>
</html>
<script src="js/jquery.2.1.1.min.js"></script>
<script src="js/angularV1.3.0-rc.2.js"></script>
<script src="js/angular-route1.4.8.min.js"></script>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
