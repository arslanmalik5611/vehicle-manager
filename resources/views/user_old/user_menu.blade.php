@extends('layout.master')
@section('page_title','User Menu Setup')

@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-user-tag fa-icon"></i> User Menu Setup </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'users'}}" class="btn btn-outline-success btn-sm">Users List</a>
                </div>
            </div>
        </div>
        <div class="card-body  user-permissions-div">
            <form method="post" id="form-data">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <p><i class="fa fa-user text-info"></i> Select a User to Set Menus</p>
                        <select name="user_id" id="employee_id" class="form-control"></select>
                    </div>
                </div>
                <div id="menu-wrapper">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="text-center">
                                <input class="form-check-input" type="checkbox" id="check-all">
                                <label class="form-check-label" for="check-all">
                                    Toggle All Menus
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card text-dark bg-light mb-3 menu-card" style="max-width: 18rem;">
                                <div class="card-header">
                                    <h4 class="section-header"><i class="fas fa-users-cog fa-icon"></i> LAB RELATED</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr class="colored-row">
                                            <th>Menu</th>
                                            <th>Create</th>
                                            <th>Edit</th>
                                            <th>List</th>
                                            <th>Delete</th>
                                        </tr>
                                        <tr>
                                            <td>Dashboard</td>
                                            <td colspan="4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox" id="dashboard"
                                                           menu-key="dashboard.index">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lab Setup</td>
                                            <td colspan="4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="lab.edit">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>User Menu Setup</td>
                                            <td colspan="4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox" id=""
                                                           menu-key="user.user_menu">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Patient Audit Trail</td>
                                            <td colspan="4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="patient.audit_trail">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Collection Center</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="collection-center.create">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="collection-center.edit">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="collection-center.list">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="collection-center.delete">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Reference</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="reference.create">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="reference.edit">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="reference.list">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="reference.delete">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Archives</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="archive.create">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="archive.edit">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="archive.list">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="archive.delete">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Roles</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="role.create">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="role.edit">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="role.list">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="role.delete">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>User</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="user.create">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="user.edit">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="user.list">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="user.delete">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>


                        </div>

                        <div class="col-md-6">
                            <div class="card text-dark bg-light mb-3 menu-card" style="max-width: 18rem;">
                                <div class="card-header">
                                    <h4 class="section-header"><i class="fas fas fa-cogs fa-icon"></i> TEST RELATED</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr class="colored-row">
                                            <th>Menu</th>
                                            <th>Create</th>
                                            <th>Edit</th>
                                            <th>List</th>
                                            <th>Delete</th>
                                        </tr>
                                        <tr>
                                            <td>Sample Type</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="sample-type.create">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="sample-type.edit">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="sample-type.list">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="sample-type.delete">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Test Category</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="test-category.create">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="test-category.edit">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="test-category.list">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="test-category.delete">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Test</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="test.create">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="test.edit">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="test.list">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="test.delete">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Report Remarks</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="report-remarks.create">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="report-remarks.edit">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="report-remarks.list">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="report-remarks.delete">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div><!--End of row-->

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card text-dark bg-light mb-3 menu-card" style="max-width: 18rem;">
                                <div class="card-header">
                                    <h4 class="section-header"><i class="fas fa-user-shield fa-icon"></i> PATIENT
                                        RELATED
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr class="colored-row">
                                            <th>Menu</th>
                                            <th>Create</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        <tr>
                                            <td>Patients</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="patient.create">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="patient.edit">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="patient.delete">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Fit to fly PCR</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="patient.fit2flypcr_create">
                                                </div>
                                            </td>
                                            <td colspan="3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="patient.fit2flypcr_edit">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Day 2 PCR</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="patient.day2pcr_create">
                                                </div>
                                            </td>
                                            <td colspan="3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="patient.day2pcr_edit">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Patient List & Filter</td>
                                            <td colspan="4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="patient.list">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pending Reports</td>
                                            <td colspan="4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="patient.pending_report_list">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pending Reports Email</td>
                                            <td colspan="4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="patient.pending_report_email_list">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Create Report</td>
                                            <td colspan="4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="patient.report_create">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>


                        </div>

                        <div class="col-md-6">
                            <div class="card text-dark bg-light mb-3 menu-card" style="max-width: 18rem;">
                                <div class="card-header">
                                    <h4 class="section-header"><i class="fas fa-shopping-cart fa-icon"></i> INVENTORY
                                        RELATED</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr class="colored-row">
                                            <th>Menu</th>
                                            <th>Create</th>
                                            <th>Edit</th>
                                            <th>List</th>
                                            <th>Delete</th>
                                        </tr>
                                        <tr>
                                            <td>Purchase</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="purchase.create">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="purchase.edit">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="purchase.list">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="purchase.delete">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Consumption</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="consumption.create">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="consumption.edit">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="consumption.list">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="consumption.delete">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Suppliers</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="supplier.create">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="supplier.edit">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="supplier.list">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="supplier.delete">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Items</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="item.create">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="item.edit">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="item.list">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="item.delete">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Item Type</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="item-type.create">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="item-type.edit">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="item-type.list">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="item-type.delete">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Items Unit</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="item-unit.create">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="item-unit.edit">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="item-unit.list">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="item-unit.delete">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div><!--End of row-->

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card text-dark bg-light mb-3 menu-card" style="max-width: 18rem;">
                                <div class="card-header">
                                    <h4 class="section-header"><i class="fas fa-chart-pie fa-icon"></i> SUMMARIES &
                                        REPORTS
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr class="colored-row">
                                            <th>Menu</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <td>Patient Summary</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="summary.patient">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Due Amount Summary</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="summary.due_amount">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tests Stats</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="summary.test_count">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rate List</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="summary.rate_list">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Purchase Summary</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="summary.purchase">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Consumption Summary</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="summary.consumption">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="card text-dark bg-light mb-3 menu-card" style="max-width: 18rem;">
                                <div class="card-header">
                                    <h4 class="section-header"><i class="fas fa-book fa-icon"></i> DOCUMENT
                                        MANAGEMENT SYSTEM
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr class="colored-row">
                                            <th>Menu</th>
                                            <th>Create</th>
                                            <th>Edit</th>
                                            <th>List</th>
                                            <th>Delete</th>
                                        </tr>
                                        <tr>
                                            <td>Document</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="document.create">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="document.edit">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="document.list">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="document.delete">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Document Approval (For Admins)</td>
                                            <td colspan="5">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="document.pending_approval">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Document Timeline (For Admins)</td>
                                            <td colspan="5">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="document.timeline">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Document Listing (Admin + Other Staff)</td>
                                            <td colspan="5">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="document.listing">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Document Public View (Admin + Other Staff)</td>
                                            <td colspan="5">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input menu" type="checkbox"
                                                           menu-key="document.view">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!--End of row-->
                </div><!--End of menu-wrapper-->
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success mb-4 submit-btn">Save <i
                            class="fas fa-chevron-right ms-3 go-icon"></i> <i
                            class="fas fa-circle-notch fa-spin spinner-icon" style="display: none"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('page_level_scripts')
    <script type="text/javascript">
        $(document).on('click', '#check-all', function () {
            $('.menu').prop('checked', $(this).is(':checked'));
        });

        $(document).on('change', '#employee_id', function () {
            if ($(this).val() != '' && $(this).val() != undefined) {
                user_menus_list($(this).val());
                $('#menu-wrapper').show();
            } else {
                $('#menu-wrapper').hide();
            }

        });

        $(document).ready(function () {
            user_load();
            employees_optional_load();

            $("#form-data").on('submit', function (e) {
                if ($('#employee_id').val() == '' || $('#employee_id').val() == undefined) {
                    Lobibox.notify('error', {
                        size: 'mini',
                        sound: false,
                        msg: 'Please choose user from dropdown'
                    });
                    return false;
                }
                $('.submit-btn').attr('disabled', true);
                $('.go-icon').hide();
                $('.spinner-icon').show();
                e.preventDefault();
                $.ajax({
                    url: api_url + "user/menus-update",
                    type: "POST",
                    data: JSON.stringify(getFormData()),
                    dataType: "JSON",
                    contentType: "application/json",
                    success: function (data) {
                        if (data.status) {
                            $('.go-icon').show();
                            $('.spinner-icon').hide();
                            $('.submit-btn').attr('disabled', false);
                            Lobibox.notify('success', {
                                size: 'mini',
                                sound: false,
                                msg: data.message
                            });

                        } else {
                            $('.submit-btn').attr('disabled', false);
                            $('.go-icon').show();
                            $('.spinner-icon').hide();
                            Lobibox.notify('error', {
                                size: 'mini',
                                sound: false,
                                msg: data.message
                            });

                        }
                    }
                });
            });
        });

        function getFormData() {
            var data = {
                'user_id': $('#employee_id').val(),
                'menus': []
            };
            $('.menu:checked').each(function (j, k) {
                data.menus.push($(k).attr('menu-key'));
            });
            return data;
        }

        function user_menus_list(user_id) {
            /*************************************
             * &USER MENUS LIST& *
             * ***********************************/
            $.ajax({
                url: api_url + 'user/' + user_id + '/menus-list',
                dataType: "JSON",
                type: 'POST',
                success: function (response) {
                    $(response.data).each(function (j, k) {
                        $(`[menu-key='${k}']`).attr('checked', true);
                    });
                }
            });
        }

        function user_load() {
            $.ajax({
                url: api_url + 'user/{{request()->id}}',
                dataType: "JSON",
                success: function (response) {
                    $('#user').html(response.data.first_name + ' ' + response.data.last_name + ' (' + response.data.email + ')');
                }
            });
        }

    </script>
@endsection

