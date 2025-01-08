<?php

namespace Api\command;

use support\Db;
use Symfony\Component\Console\Command\Command;
use Illuminate\Database\Schema\Blueprint;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class InstallApiCommand extends Command
{
    protected static string $defaultName = 'api:install';

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->info('开始安装 API 数据库表...');

        try {
            if (DB::schema()->hasTable('api_request_logs')){
                $io->warning('数据库表已存在！');
                return self::SUCCESS;
            }
            // 执行数据库表创建
            Db::schema()->create('api_request_logs', function (Blueprint $table) {
                $table->id()->comment('ID');
                $table->string('ip', 45)->comment('客户端IP地址');
                $table->string('method', 10)->comment('请求方法');
                $table->string('uri', 255)->comment('请求URI');
                $table->text('user_agent')->nullable()->comment('浏览器信息');
                $table->unsignedInteger('status')->comment('HTTP 状态码');
                $table->float('response_time')->comment('响应时间（秒）');
                $table->dateTime('created_at')->comment('创建时间');
            });

            $io->success('数据库表安装成功！');
            return self::SUCCESS;
        } catch (\Exception $e) {
            $io->error('数据库表安装失败：' . $e->getMessage());
            return self::FAILURE;
        }
    }
}
