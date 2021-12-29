<?php

namespace HDSSolutions\Laravel\Models;

use HDSSolutions\Laravel\Traits\BelongsToCompany;

abstract class X_CashBookUser extends Base\Pivot {
    use BelongsToCompany;

}
