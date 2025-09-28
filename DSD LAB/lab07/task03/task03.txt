module Clock_Divider(clock_in, clock_out);
    input clock_in;
    output reg clock_out = 0;
    reg [27:0] counter = 28'd0;
    parameter DIVISOR = 28'd100000000;
     
    always @(posedge clock_in) begin
        if (counter == (DIVISOR - 1)) begin
            counter <= 28'd0;
            clock_out <= ~clock_out;
        end else begin
            counter <= counter + 1;
        end
    end
endmodule

module up_down_counter(clock_in, rst, COUNT);
    input clock_in, rst;
    output reg [2:0] COUNT = 3'd0;
    wire clock_out;

    Clock_Divider c(clock_in, clock_out);

    always @(posedge clock_out) begin
        if (rst) begin
            // Count up
            COUNT <= COUNT + 1;
        end else begin
            // Count down
            COUNT <= COUNT - 1;
        end
    end
endmodule

module BCD(bcd, seg);
    input [2:0] bcd;
    output reg [10:0] seg;
    
    always @(*) begin
        case ({1'b0, bcd})
            4'b0000: seg = 11'b10000000011; //0
            4'b0001: seg = 11'b11110010011; //1
            4'b0010: seg = 11'b01001001011; //2
            4'b0011: seg = 11'b01100000011; //3
            4'b0100: seg = 11'b00110010011; //4
            4'b0101: seg = 11'b00100100011; //5
            4'b0110: seg = 11'b00000100011; //6
            4'b0111: seg = 11'b11110000011; //7
            default: seg = 11'b00000010011; //error
        endcase
    end
endmodule

module Top(clk, rst, seg);
    input clk, rst;
    output [10:0] seg;
    wire [2:0] count;

    up_down_counter udc(clk, rst, count);
    BCD bcd_decoder(count, seg);
endmodule
