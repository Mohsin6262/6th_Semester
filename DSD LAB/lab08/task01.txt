// BCD Counter
module BCD_Counter (input CLOCK, input CLR, output reg [3:0] Q);
    always @(negedge CLOCK or posedge CLR) begin
        if (CLR)
            Q <= 4'd0;
        else if (Q == 4'd9)
            Q <= 4'd0;
        else
            Q <= Q + 1;
    end
endmodule

// Three BCD Counters (unit, ten, hundred)
module three_BCD(input CLOCK, input CLR, output [3:0] BCDu, BCDt, BCDh);
    wire tc_u, tc_t;
    
    BCD_Counter bcdu(CLOCK, CLR, BCDu);
    BCD_Counter bcdt(BCDu[3], CLR, BCDt);
    BCD_Counter bcdh(BCDt[3], CLR, BCDh);
endmodule

// BCD to 7 Segment
module BCD_to_7seg(input [3:0] bcd, output reg [7:0] seg);
    always @(*) begin
        case (bcd)
            4'b0000: seg = 8'b11000000; // 0
            4'b0001: seg = 8'b11111001; // 1
            4'b0010: seg = 8'b10100100; // 2
            4'b0011: seg = 8'b10110000; // 3
            4'b0100: seg = 8'b10011001; // 4
            4'b0101: seg = 8'b10010010; // 5
            4'b0110: seg = 8'b10000010; // 6
            4'b0111: seg = 8'b11111000; // 7
            4'b1000: seg = 8'b10000000; // 8
            4'b1001: seg = 8'b10010000; // 9
            default: seg = 8'b11111111; // error
        endcase
    end
endmodule

// Clock Divider
module Clock_Divider(input clock_in, output reg clock_out);
    reg [27:0] counter = 28'd0;
    parameter DIVISOR = 28'd100000000;  // Adjust according to FPGA clock

    always @(posedge clock_in) begin
        if (counter == DIVISOR-1) begin
            counter <= 28'd0;
            clock_out <= ~clock_out;
        end else begin
            counter <= counter + 1;
        end
    end
endmodule

// 18-bit Counter
module Counter18bit(input clk, input rst, output reg [17:0] count);
    always @(posedge clk or posedge rst) begin
        if (rst)
            count <= 18'd0;
        else
            count <= count + 1;
    end
endmodule

// 4X1 Multiplexer
module mux4X1(
    input [7:0] bcd0, 
    input [7:0] bcd1, 
    input [7:0] bcd2, 
    input [1:0] select, 
    output reg [7:0] out
);
    always @(*) begin
        case(select)
            2'b00: out = bcd0;
            2'b01: out = bcd1;
            2'b10: out = bcd2;
            default: out = 8'b11111111; // blank
        endcase
    end
endmodule

// 2X4 Decoder
module decoder2X4(
    input [1:0] select,
    output reg [3:0] out
);
    always @(*) begin
        case(select)
            2'b00: out = 4'b1110;
            2'b01: out = 4'b1101;
            2'b10: out = 4'b1011;
            2'b11: out = 4'b0111;
        endcase
    end
endmodule

// Top Module
module topMultiplexer(
    input clk,
    input rst,
    output [3:0] out_dec,
    output [7:0] out_mux
);
    wire slow_clock;
    wire [3:0] BCDu, BCDt, BCDh;
    wire [7:0] bcd1, bcd2, bcd3;
    wire [17:0] counter_out;

    Counter18bit cnt(clk, rst, counter_out);
    Clock_Divider divider(clk, slow_clock);

    three_BCD three_BCD_Counters(slow_clock, rst, BCDu, BCDt, BCDh);
    BCD_to_7seg B1(BCDu, bcd1);
    BCD_to_7seg B2(BCDt, bcd2);
    BCD_to_7seg B3(BCDh, bcd3);

    mux4X1 Mux(bcd1, bcd2, bcd3, counter_out[17:16], out_mux);
    decoder2X4 d1(counter_out[17:16], out_dec);
endmodule
