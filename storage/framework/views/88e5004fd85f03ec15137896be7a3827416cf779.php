<?php $__currentLoopData = session('flash_notification', collect())->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($message['overlay']): ?>
        <?php echo $__env->make('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
        <div class="alert alert-dismissible
                    alert-<?php echo e($message['level']); ?>

                    <?php echo e($message['important'] ? 'alert-important' : ''); ?>"
                    role="alert"
        >
            
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            
            <?php if(is_array($message['message'])): ?>
                <ul>
                <?php $__currentLoopData = $message['message']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo $msg; ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php else: ?>
                <?php echo $message['message']; ?>

            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php echo e(session()->forget('flash_notification')); ?>

