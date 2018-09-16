<?php
/**
 * @package    Product Module
 * @author     Dasitha Abeysinghe <dazimax@gmail.com>
 */
?>
@include('layouts.master.messages')
        <!DOCTYPE html>
<html>
<head>
    @include('layouts.master.header')
</head>
<body class="fixed-left">
<div id="wrapper">
    <div class="topbar">
    </div>
    <div class="left side-menu">
        @include('layouts.master.sidebar')
    </div>
    <div class="content-page">
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class="content">
            <!-- Page Heading Start -->
            <div class="row">
                <div class="col-md-12">
                    @if (isset($product))
                        <div class="page-heading">
                            <h1><i class='fa fa-check'></i> Product Edit</h1>
                        </div>
                        <div class="widget" ng-app="ecommerceapp">
                            <div class="widget-header transparent">
                                <h2><strong>Product</strong> Details</h2>
                            </div>
                            <div class="widget-content padding">
                                <form class="form-horizontal" method="POST" action="{{ url('/save') }}" role="form"
                                      enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="input-text" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="prod_name" value="{{ $product->prod_name }}"
                                                   class="form-control" id="prod_name"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input-text"
                                               class="col-sm-2 control-label">Details</label>
                                        <div class="col-sm-5">
                                            <textarea name="prod_details" class="form-control"
                                                      id="prod_details">{{ $product->prod_details }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Category</label>
                                        <div class="col-sm-5">
                                            @if(count($categories) > 0)
                                                <ul style="padding: 0 20px">
                                                    @foreach ($categories as $category)
                                                        <li style="list-style: none;">
                                                            <label><b>{{ $category->cat_name }}</b></label>
                                                        </li>
                                                        @endforeach
                                                        </li>
                                                </ul>
                                            @endif
                                            @if(count($defaultcategories) > 0)
                                                <ul style="padding: 0 20px">
                                                    @foreach ($defaultcategories as $defaultcategory)
                                                        <li style="list-style: none;">
                                                            <label class="checkbox-inline"
                                                                   style="display: inline;padding:0">
                                                                <input style="float:left;" type="checkbox"
                                                                       name="category[]"
                                                                       value="{{ $defaultcategory->cat_id }}"
                                                                       class="category-checkbox"/>
                                                                <label>{{ $defaultcategory->cat_name }}</label>
                                                            </label>
                                                        </li>
                                                        @endforeach
                                                        </li>
                                                </ul>
                                            @else
                                                <label>Not found any product categories</label>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Gallery Images</label>
                                        <div class="col-sm-5">
                                            <div class="col-sm-12" style="padding-left: 0px;">
                                                @if(count($images) > 0)
                                                    <ul style="padding: 0 20px">
                                                        @foreach ($images as $image)
                                                            <li style="list-style: none;">
                                                                <img style="width: 150px;" src="<?php echo ($image->gallery_img_path != '')?$image->gallery_img_path:'' ?>"/>
                                                            </li>
                                                            @endforeach
                                                            </li>
                                                    </ul>
                                                @else
                                                    <label>Not found any product Images</label>
                                                @endif
                                                <div ng-controller="duplicateItemsCtrl">
                                                    <div ng-repeat="imageItem in imageItems">
                                                        <input type="file" name="gallery_img_path[]" value=""
                                                               class="form-control gallery_img_path"/><br/>
                                                    </div>
                                                    <button type="button" ng-click="addImage()">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Product Qty & Price</label>
                                        <div class="col-sm-5">
                                            @if(count($inventoryprices) > 0)
                                                <ul style="padding: 0 20px">
                                                    @foreach ($inventoryprices as $inventoryprice)
                                                        <li style="list-style: none;">
                                                            <label><b>Qty : </b>&nbsp;{{ $inventoryprice->inven_qty }}&nbsp;<b>Price : </b>&nbsp;{{ $inventoryprice->inven_price }}</label>
                                                        </li>
                                                        @endforeach
                                                        </li>
                                                </ul>
                                            @endif
                                            <div ng-controller="duplicateItemsCtrl">
                                                <div ng-repeat="qtyItem in qtyItems">
                                                    <div class="row-sm-5 form-group">
                                                        <div class="col-sm-3">
                                                            <input type="text" name="inven_qty[]" value=""
                                                                   class="form-control inven_qty"/>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="inven_price[]" value=""
                                                                   class="form-control inven_price"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" ng-click="addQtyPrice()">+</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Status</label>
                                        <div class="col-sm-5">
                                            <select style="margin: 10px 10px 0 0;" name="prod_is_visible">
                                                <option value="1">Enable</option>
                                                <option value="0">Disable</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">&nbsp;</label>
                                        <div class="col-sm-5">
                                            <button type="submit" class="btn btn-info">Save</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="prod_id" value=""/>
                                </form>
                            </div>
                        </div>

                    @else

                        <div class="page-heading">
                            <h1><i class='fa fa-check'></i> Manage Products</h1>
                        </div>

                        <div class="widget" ng-app="ecommerceapp">
                            <div class="widget-header transparent">
                                <h2><strong>Product</strong> Details</h2>
                            </div>
                            <div class="widget-content padding">

                                <form class="form-horizontal" method="POST" action="{{ url('/save') }}" role="form"
                                      enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="input-text" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="prod_name" value=""
                                                   class="form-control" id="prod_name"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input-text"
                                               class="col-sm-2 control-label">Details</label>
                                        <div class="col-sm-5">
                                            <textarea name="prod_details" class="form-control"
                                                      id="prod_details"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Category</label>
                                        <div class="col-sm-5">
                                            @if(count($defaultcategories) > 0)
                                                <ul style="padding: 0 20px">
                                                    @foreach ($defaultcategories as $defaultcategory)
                                                        <li style="list-style: none;">
                                                            <label class="checkbox-inline"
                                                                   style="display: inline;padding:0">
                                                                <input style="float:left;" type="checkbox"
                                                                       name="category[]"
                                                                       value="{{ $defaultcategory->cat_id }}"
                                                                       class="category-checkbox"/>
                                                                <label>{{ $defaultcategory->cat_name }}</label>
                                                            </label>
                                                        </li>
                                                        @endforeach
                                                        </li>
                                                </ul>
                                            @else
                                                <label>Not found any product categories</label>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Gallery Images</label>
                                        <div class="col-sm-5">
                                            <div class="col-sm-12" style="padding-left: 0px;">
                                                <div ng-controller="duplicateItemsCtrl">
                                                    <div ng-repeat="imageItem in imageItems">
                                                        <input type="file" name="gallery_img_path[]" value=""
                                                               class="form-control gallery_img_path"/><br/>
                                                    </div>
                                                    <button type="button" ng-click="addImage()">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Product Qty & Price</label>
                                        <div class="col-sm-5">
                                            <div ng-controller="duplicateItemsCtrl">
                                                <div ng-repeat="qtyItem in qtyItems">
                                                    <div class="row-sm-5 form-group">
                                                        <div class="col-sm-3">
                                                            <input type="text" name="inven_qty[]" value=""
                                                                   class="form-control inven_qty"/>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="inven_price[]" value=""
                                                                   class="form-control inven_price"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" ng-click="addQtyPrice()">+</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Status</label>
                                        <div class="col-sm-5">
                                            <select style="margin: 10px 10px 0 0;" name="prod_is_visible">
                                                <option value="1">Enable</option>
                                                <option value="0">Disable</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">&nbsp;</label>
                                        <div class="col-sm-5">
                                            <button type="submit" class="btn btn-info">Save</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="prod_id" value=""/>
                                </form>
                            </div>
                        </div>
                    @endif

                    <hr/>
                    {{--Products List--}}
                    <div class="widget">
                        <div class="widget-header transparent">
                            <h2><strong>Products List</strong></h2>
                        </div>
                        <div class="widget-content">
                            <div class="data-table-toolbar">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="toolbar-btn-action">
                                            <a href="{{ url('/') }}" class="btn btn-success"><i
                                                        class="fa fa-plus-circle"></i> Add
                                                new</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table data-sortable class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Details</th>
                                        <th>Status</th>
                                        <th data-sortable="false">Option</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->prod_id }}</td>
                                            <td>{{ $product->prod_name }}</td>
                                            <td>{{ $product->prod_details }}</td>
                                            <td>
                                                <?php
                                                if($product->prod_is_visible == 1){
                                                ?>
                                                <span class="label label-success">Enable</span>
                                                <?php }else{ ?>
                                                <span class="label label-warning">Disabled</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="{{ url('/view/'.$product->prod_id) }}"
                                                   data-toggle="tooltip" title="Edit"
                                                   class="btn btn-info"><i
                                                            class="fa fa-edit"></i></a>
                                                <a href="{{ url('/remove/'.$product->prod_id) }}"
                                                   data-toggle="tooltip" title="Remove"
                                                   class="btn btn-danger"><i
                                                            class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>