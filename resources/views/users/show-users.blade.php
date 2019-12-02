@extends('layouts.app')
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
<style type="text/css">
  td.details-control {
    text-align:center;
    color:forestgreen;
    cursor: pointer;
  }
  tr.shown td.details-control {
    text-align:center; 
    color:red;
  }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body shadow">
                  <table width="100%" class="display" id = "data-table" cellspacing="0">
                            
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            function format ( d ) {                         
                return '<table>'+
                            '<tr>'+
                                '<td style="padding-left:50px;">Nombre:</td>'+
                                '<td><b>'+d.full_name+'</b></td>'+
                            '</tr>'+
                            '<tr>'+
                            '</tr>'+
                        '</table>';
            }

            var dataSet = {!!json_encode($users)!!};

            var table = $('#data-table').DataTable({
                    data: dataSet,
                    columns: [
                        {
                            className:      'details-control',
                            orderable:      false,
                            data:           null,
                            width:          "15px",
                            defaultContent: '',
                            render: function () {                                                    
                             return '<i class="fa fa-plus-square" aria-hidden="true"></i>';
                            },
                        },
                        { data: null, targets: 0, title: "RFC",
                          render:   function ( data, type, row, meta) {
                            
                            url = "#";

                            return '<a  href="'+url+'">'+data.name+'</a>';
                                       
                            }
                        },
                        { data: "email", title: "Correo"},
                        { data: "email_verified_at", title: "Ultimo Acceso", className: 'hidden-xs hidden-sm' },                        
                        { data: "role", targets: 0, title: "Tipo", className: 'hidden-xs hidden-sm',
                          render:   function ( data, type, row, meta ) {

                                            if (data == "Usuario") {
                                              badgeClass = "success";
                                            } else if (data == "Administrador") {
                                              badgeClass = "warning";
                                            } else if (data == "Desactivado") {
                                              badgeClass = "secondary";
                                            } else if (data == "Pagador") {
                                              badgeClass = "primary";
                                            }else {
                                              badgeClass = "dark";
                                            }

                                      return '<span class="badge badge-'+badgeClass+'">'+data+'</span>';
                                    }
                        },  
                        { data: null, targets: 0,
                          render:   function ( data, type, row, meta) {
                            
                            url = "{{ URL::to('users/:id/edit') }}";
                            url = url.replace(':id', data.id);

                            return '<a class="btn btn-sm btn-info btn-block" href="'+url+'"><i class="fas fa-pencil-alt fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span></a>';
                                       
                            }
                        },
                        { data: null, targets: 0,
                          render:   function ( data, type, row, meta) {

                            url = "{{ URL::to('users/:id') }}";
                            url = url.replace(':id', data.id);
                        return '<form method="POST" action="'+url+'"> @csrf @method('DELETE')<button type="button" class="btn btn-danger btn-sm" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Borrar Usuario" data-message="Esta seguro que desea eliminar este usuario '+data.name+' de forma permanente?"><i class="fas fa-trash-alt fa-fw" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Eliminar</span></button></form>';
                           
                            }
                        },
                        { data: "full_name", visible: false }   
                   
                    ],
                    order: [[4, 'asc']],
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                    }
            });

            $('#data-table tbody').on('click', 'td.details-control', function () {
                
                var tr = $(this).closest('tr');
                var tdi = tr.find("i.fa");
                var row = table.row( tr );
         
                if ( row.child.isShown() ) {
                    row.child.hide();
                    tr.removeClass('shown');
                    tdi.first().removeClass('fa-minus-square');
                    tdi.first().addClass('fa-plus-square');
                }
                else {
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                    tdi.first().removeClass('fa-plus-square');
                    tdi.first().addClass('fa-minus-square');
                }
            });

            
        });
    </script>


    <script type="text/javascript">
      /*
      $('#confirmDelete').on('show.bs.modal', function (e) {
        var message = $(e.relatedTarget).attr('data-message');
        var title = $(e.relatedTarget).attr('data-title');
        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-body p').text(message);
        $(this).find('.modal-title').text(title);
        $(this).find('.modal-footer #confirm').data('form', form);
      });
      $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
          $(this).data('form').submit();
      });
      */
    </script>


@endsection
