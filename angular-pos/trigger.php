<div class="modal fade" id="product" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title caps"><strong>New Product</strong></h4>
            </div>
            <div class="modal-body">
                <form novalidate="novalidate">
                    <div class="form-group">
                        <label for="sel1">Select Category:</label>
                        <select ng-model="catg" name="catg" ng-change="loadCategory()" class="form-control" id="sel1"ng-options="cat.cat_id as cat.cat_name for cat in categories" ng-required="true">
                            <option value="">Category Selection</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control" required autofocus ng-model="angCtrl.inputData.prodt" id="inputprodt" type="text" ng-minlength="3"ng-pattern="[A-Za-z]" title="Product Should Be More Than 3 Letters" placeholder="New Product Name"autocomplete="Off">
                    </div>
                    <div class="form-group">
                        <input class="form-control" required autofocus ng-model="angCtrl.inputData.price" id="inputprice" type="number"title="Product price" placeholder="product Price"autocomplete="Off" ng-required="required">
                    </div>

                    <button class="btn btn-default" ng-click="angCtrl.NewProduct()" type="button">Insert Product</button>
                    <div class="alert alert-danger" ng-show="errorsms">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button>
                        <span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;{{errorsms}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="category" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title caps"><strong>New Category</strong></h4>
                </div>
                <div class="modal-body">
                    <form novalidate="novalidate">
                        <div class="form-group">
                            <input class="form-control" required autofocus ng-model="angCtrl.inputData.categ" id="inputcateg" type="text" ng-minlength="3"ng-pattern="[A-Za-z]" title="Category Should Be More Than 3 Letters" placeholder="New Product Category Name"autocomplete="Off">
                        </div>
                        <button class="btn btn-default" ng-click="angCtrl.NewCategory()" type="button">Submit</button>
                        <div class="alert alert-danger" ng-show="errorsms">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                ×</button>
                            <span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;{{errorsms}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>