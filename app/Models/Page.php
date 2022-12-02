<?php

namespace App\Models;

use App\Helpers\BBCodeConverter;
use App\Helpers\MarkdownExtra;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * Set The Pages Content After Its Been Purified.
     */
    public function setContentAttribute(?string $value): void
    {
        $this->attributes['content'] = $value;
    }

    /**
     * Parse Content And Return Valid HTML.
     */
    public function getContentHtml(): ?string
    {
        $content = (new BBCodeConverter($this->content))->toMarkdown();

        return (new MarkdownExtra())->text($content);
    }
}
