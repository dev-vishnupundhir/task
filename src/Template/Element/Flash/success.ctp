<style>
.message.success {
    background-color: #B7E9F2;
    border: 1px solid #B7E9F2;
    color: #27B8D1;
    float: left;
    margin: 0;
    padding: 10px;
    position: absolute;
    text-align: center;
    top: 0;
    width: 100%;
    z-index: 999;
}
</style>

<div class="message success" onclick="this.classList.add('hidden')"><?= h($message) ?></div>
<script type="text/javascript">
	$(document).ready(function() {
	$('.message').delay(4000).fadeOut(400);
});
</script>
