<?php

namespace PhpSnipper\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:snippet',
    description: 'Calll a snippet.',
    hidden: false
)]
class SnippetCaller extends Command
{

  protected function configure(): void
  {
      $this->addArgument('name', null, 'The snippet you want to call.');
  }

  protected function execute(InputInterface $input, OutputInterface $output): int
  {

    $path = SNIPPET_PATH . DIRECTORY_SEPARATOR . $input->getArgument('name') . '.php';

    if (!file_exists($path)) {
      $output->writeln('<error>Sorry the "'.$input->getArgument('name').'" snippet does not exists.</error>');
      return Command::FAILURE;
    }

    ob_start();
    // Include the PHP file whose content you want to capture
    include $path;
    // Get the content of the output buffer
    $content = ob_get_clean();
    // Output the captured content
    echo $content . PHP_EOL;

    return Command::SUCCESS;
  }
}