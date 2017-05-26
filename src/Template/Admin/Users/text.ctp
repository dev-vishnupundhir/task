<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">        
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?php echo HTTP_ROOT.'admin/users/dashboard'?>">Home</a>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                <li>
                    <span>Texts Managements</span>
                </li>
            </ul>
        </div>
        <?php echo $this->Flash->render(); ?>
        <h3 class="page-title"> Texts Managements</h3>
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Texts Managements
                </div>
            </div>
            <div class="portlet-body">
                <div clss="col-md-12">
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" > No. </th>
                                    <th scope="col"> Section </th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Sub Title </th>
                                    
                                    <th scope="col"> Description </th>
                                    <th scope="col"> Description Two </th>
                                    <th scope="col"> Image </th>
                                    <th scope="col"> Action </th>    
                                </tr>   
                            </thead>
                                <?php $i = 1;
                                    if (!empty($txt)) {
                                        $i = $this->Paginator->counter('{{start}}');
                                            foreach ($txt as $key => $list) {   
                                    ?>
                                <tbody>
                                    <tr> 
                                        <td><?php  echo $i; ?> </td>
                                        <td><?php echo substr($list['section'], 0 ,30); ?></td>
                                        <td> <?php echo substr($list['title'],0,25); ?> </td>
                                        <td> <?php echo substr($list['subtitle'], 0 ,35); ?> </td>
                                        
                                        <td><?php echo substr($list['description'], 0 ,100); ?>
                                        <td><?php echo substr($list['description_two'], 0 ,100); ?>    
                                        </td>
                                        <td><img src="<?php if(!empty($list['image']) && file_exists('img/images/'.$list['image'])) {echo HTTP_ROOT.'img/images/'.$list['image']; } else { echo HTTP_ROOT.'img/staticImage/upld.png';}?>" width ="80px" height="100px"></td>
                                        <td style="text-align: center;"> 
                                            <?php $id = $this->Utility->encode($list['id']); ?>
                                             <a title="Edit"  class="btn btn-sm blue margin-top-10" href="<?php echo HTTP_ROOT.'admin/users/editText/'.$id;?>"> <i class="fa fa-edit"></i>
                                            </a>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                                <?php $i++; } } ?>
                        </table>        
                         <nav class="text-center">
                            <ul class="pagination">
                              <?php
                                echo $this->Paginator->prev('«', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                                echo $this->Paginator->next('»', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                                ?>
                            </ul>
                          </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   
</script>

