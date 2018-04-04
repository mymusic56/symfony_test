<?php
namespace AppBundle\Command;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * useage: 
 * # php bin/console app:create-user
 *   successfully create a new user.
 *  
 * @author zhangshengji
 * @datetime 2018年4月4日 下午4:33:06
 */
class CreateUserCommand extends ContainerAwareCommand
{

    /**
     *
     * {@inheritdoc}
     * @see \Symfony\Component\Console\Command\Command::configure()
     */
    protected function configure()
    {
        $this->
        // the name of the command (the part after "bin/console")
        setName('app:create-user')
            ->
        // the short description shown while running "php bin/console list"
        setDescription('Creates a new user.')
            ->
        // the full command description shown when running the command with
        // the "--help" option
        setHelp('This command allows you to create a user...');
        
        $this->addArgument('name', InputArgument::REQUIRED, 'The username of the user.');
        $this->addArgument('pwd', InputArgument::REQUIRED, 'The password of the user.');
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Symfony\Component\Console\Command\Command::execute()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $pwd = $input->getArgument('pwd');
        
        $em = $this->getContainer()->get('doctrine')->getManager();
        $userRepository = $em->getRepository(User::class);
        
        /* @var $userRepository \AppBundle\Repository\UserRepository */
        $users = $userRepository->findBy([
            'groupId' => 1
        ]);
        
        $result = [];
        /* @var $user \AppBundle\Entity\User */
        foreach ($users as $user) {
            $result[] = [
                'id' => $user->getId(),
                'name' => $user->getName(),
            ];
        }
        
        //persist data
        $new_user = new User();
        $new_user->setName($name);
        $new_user->setPwd($pwd);
        
        $em->persist($new_user);
        $em->flush();
        
        var_dump($result);
        
        $output->writeln([
            'successfully create a new user.',
            "username is {$name}, passord is {$pwd}, id is: {$new_user->getId()}"
        ]);
    }
}