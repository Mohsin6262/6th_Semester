`timescale 1ns / 1ps

module counter_tb;

reg clk;
reg rst;
wire [3:0] count;

// Instantiate the counter
counter uut (
    .clk(clk),
    .rst(rst),
    .count(count)
);

// Generate clock: 10ns period (100MHz)
always #5 clk = ~clk;

initial begin
    // Initialize inputs
    clk = 0;
    rst = 1;

    // Reset the counter
    #10;
    rst = 0;

    // Run simulation for 200 ns
    #200;

    $stop;
end

endmodule
