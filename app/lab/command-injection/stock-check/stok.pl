my ($product_id) = @ARGV;

if (not defined $product_id) {
  die "Need Product ID\n";
}

if(defined $product_id) {
    print(": 13\n") if($product_id == 1);
    print(": 26\n") if($product_id == 2);
    print(": 35\n") if($product_id == 3);

}