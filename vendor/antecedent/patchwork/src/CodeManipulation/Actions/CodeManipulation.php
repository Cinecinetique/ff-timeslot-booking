<?php

/**
 * @author     Ignas Rudaitis <ignas.rudaitis@gmail.com>
 * @copyright  2010-2016 Ignas Rudaitis
 * @license    http://www.opensource.org/licenses/mit-license.html
 */
namespace Patchwork\CodeManipulation\Actions\CodeManipulation;

use Patchwork\CodeManipulation\Actions\Generic;
use Patchwork\CodeManipulation\Source;

const EVAL_ARGUMENT_WRAPPER = '\Patchwork\CodeManipulation\transformForEval';

function propagateThroughEval()
{
    return Generic\wrapUnaryConstructArguments(T_EVAL, EVAL_ARGUMENT_WRAPPER);
}

function flush()
{
    return function(Source $s) {
        $s->flush();
    };
}
