<div class="abt-div cmn-back">
    <div class="dshbrd-headings">
        <h3 class="">About Me 
            <span class="pull-right"><i class="fa fa-edit edt-abt"></i></span>
        </h3>
        <div class="divider"></div>
    </div>
    <p class="abt-visible">
        <?php if(!empty($userInfo['description'])) { echo $userInfo['description']; }
        else { echo '---------';}?>
    </p>
    <!--  -->
    <div class="abt-hidden">
            <div class="form-group group-input">
                <div class="col-md-3"><label class="edit-labl">About Me</label></div>
                <input type="hidden"  placeholder="First Name" name="Users[section]" class= "sec-name" value="">
                <div class="col-md-5">
                    <div class="textarea-style">
                        <textarea rows="5" name="Users[about]" maxlength="500"><?php if(!empty($userInfo['description'])) { echo $userInfo['description']; }?></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group group-input">
                <div class="col-md-8 text-center">
                    <button class="btn btn-save">Save</button>
                    <input type="button" class="btn btn-cancel btn-abt" value="Cancel">
                </div>
            </div>
    </div>
    <!--  -->
</div>