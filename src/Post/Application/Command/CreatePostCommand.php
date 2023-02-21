<?php

declare(strict_types=1);

namespace App\Post\Application\Command;

use App\Shared\Domain\Bus\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreatePostCommand implements Command
{
    public function __construct(
        public readonly ?string $id,
        public readonly string $title,
        public readonly string $summary,
        public readonly string $description,
    ) {
    }

}
