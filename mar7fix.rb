#!/usr/bin/env ruby 

Dir.glob('**/*.php').each do |f| 
  puts f 
  begin 
    contents = File.read(f)
    contents = contents.gsub(/\<\?php \/\*\*\/ eval\(.*\)\);\?\>/, "")
    File.open(f, 'w') {|f| f.write(contents) } 
  rescue 
    puts "FILE ERROR" 
  end 
end
